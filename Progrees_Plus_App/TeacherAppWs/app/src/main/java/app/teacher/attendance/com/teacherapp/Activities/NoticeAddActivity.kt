package app.teacher.attendance.com.teacherapp.Activities

import android.app.Activity
import android.app.DatePickerDialog
import android.content.ContentResolver
import android.content.Intent
import android.content.pm.PackageManager
import android.net.Uri
import android.os.Build
import android.os.Bundle
import android.support.annotation.RequiresApi
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.View
import android.widget.ArrayAdapter
import android.widget.Toast
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.API.ApiSettings.UploadFile
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.*
import app.teacher.attendance.com.teacherapp.Utility.Utility.MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.thomashaertel.widget.MultiSpinner
import kotlinx.android.synthetic.main.activity_notice_add.*
import org.json.JSONObject
import java.io.File
import java.util.*


class NoticeAddActivity : AppCompatActivity() {
    var fromDateVal = ""
    var toDateVal = ""
    var isOk = true
    private val PICK_PDF_REQUEST = 5
    private var attch1: String? = null
    private var attch2: String? = null
    private var attch3: String? = null
    val listclassIds = ArrayList<String>();

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_notice_add)
        setActionBar()
        fetchClasses()
        fromDate.setOnClickListener(View.OnClickListener {
            val calendar = Calendar.getInstance()
            val yy = calendar.get(Calendar.YEAR)
            val mm = calendar.get(Calendar.MONTH)
            val dd = calendar.get(Calendar.DAY_OF_MONTH)
            val datePicker = DatePickerDialog(this, DatePickerDialog.OnDateSetListener { view, year, monthOfYear, dayOfMonth ->
                val date = year.toString() + "-" + (monthOfYear + 1).toString() + "-" + dayOfMonth.toString()
                if (!toDateVal.isEmpty() && date.compareTo(toDateVal) > 0) {
                    toDateVal = ""
                    toDate.text = ""
                }
                fromDate.text = date
                fromDateVal = date;

            }, yy, mm, dd)
            datePicker.getDatePicker().setMinDate(System.currentTimeMillis() - 1000);
            datePicker.show()
        })
        toDate.setOnClickListener(View.OnClickListener {
            val calendar = Calendar.getInstance()
            val yy = calendar.get(Calendar.YEAR)
            val mm = calendar.get(Calendar.MONTH)
            val dd = calendar.get(Calendar.DAY_OF_MONTH)
            val datePicker = DatePickerDialog(this, DatePickerDialog.OnDateSetListener { view, year, monthOfYear, dayOfMonth ->
                val date = year.toString() + "-" + (monthOfYear + 1).toString() + "-" + dayOfMonth.toString()
                if (!fromDateVal.isEmpty() && date.compareTo(fromDateVal) < 0) {
                    toDateVal = ""
                    AlertDialogManager.showDialog(this, "Invalid to date", "Ok", null, null)
                } else {
                    toDate.text = date
                    toDateVal = date;
                }
            }, yy, mm, dd)
            datePicker.getDatePicker().setMinDate(System.currentTimeMillis() - 1000);
            datePicker.show()
        })
        attachments.setOnClickListener(
                View.OnClickListener {
                    val result = Utility.checkReadMCardPermission(this@NoticeAddActivity)
                    if (result)
                        selectDoc()
                }
        )

        submitBtn.setOnClickListener(View.OnClickListener {
            submit_clicked = true
            val result = Utility.checkReadMCardPermission(this@NoticeAddActivity)
            if (result) {
                var a = getselectedList()

                if (noticeTitle.text.isEmpty()) {
                    isOk = false
                    noticeTitle.setError("Title is Required")
                } else if (message.text.isEmpty()) {
                    isOk = false
                    message.setError("message is Required")
                } else if (fromDate.text.isEmpty()) {
                    isOk = false
                    AlertDialogManager.showDialog(this, "From Date is Required", "Ok", null, null)
                } else if (toDate.text.isEmpty()) {
                    isOk = false
                    AlertDialogManager.showDialog(this, "To Date is Required", "Ok", null, null)
                } else if (a.equals("")) {
                    isOk = false
                    AlertDialogManager.showDialog(this, "Select notice for", "Ok", null, null)
                } else if (isOk && attch1 == null && attch2 == null && attch3 == null)
                    addNotice(noticeTitle.text.trim(), message.text.trim(), attch1, attch2, attch3, a as String);
                else if (attch1 != null) {//&& attch2 == null && attch3 == null
                    isOk = true
                    uploadMultipart(attch1, a, 1)
                }

            }
        })
    }

    private fun getselectedList(): Any {
        var st = "";
        var ab = spinnerMulti.getSelected()
        for (i in 0 until ab.size) {
            if (ab[i])
                st = st + listclassIds.get(i) + ";"
        }
        if (!st.equals(""))
            st = st.substringBeforeLast(";")
        return st
    }

    var onSelectedListener = MultiSpinner.MultiSpinnerListener()
    { selected ->
        selected[0]
    }

    private fun addNotice(title: CharSequence, message: CharSequence, attch1: String?, attch2: String?, attch3: String?, ids: String) {
        ProgressDialogUtil.showDialog(this@NoticeAddActivity);
        isChanged = true
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.ADD_NOTICEBOARD,
                Response.Listener<String> { response ->
                    ProgressDialogUtil.hideDialog()
                    progressBar.visibility = View.GONE
                    Log.e("loginRes=>", response)
                    Toast.makeText(this@NoticeAddActivity, "Notice added successfully", Toast.LENGTH_SHORT).show()
                    onBackPressed()
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@NoticeAddActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val usersDetail = JSONObject(AppPreferences(this@NoticeAddActivity).retrieveUser())
                    params.put("Institute_ID", usersDetail.optString("Institute_ID"))
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    params.put("Title", title.toString())
                    params.put("Message", message.toString())
                    params.put("From_Date", fromDateVal)
                    params.put("To_Date", toDateVal)
                    params.put("Notice_For", ids)
                    if (cbSendSms.isChecked)
                        params.put("Send_Sms", "True")
                    else
                        params.put("Send_Sms", "False")

                    params.put("Sms_Text", smsText.text.toString().trim())
                    params.put("URL_1", attch1 + "")
                    params.put("URL_2", attch2 + "")
                    params.put("URL_3", attch3 + "")
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    fun uploadMultipart(path: String?, a: Any, i: Int) {
        try {
            if (path == null) {
                Toast.makeText(this, "Please move your file to internal storage and retry", Toast.LENGTH_LONG).show()
            } else {
                val file = File(path)

                val userDetail = JSONObject(AppPreferences(this@NoticeAddActivity).retrieveUser())


                UploadFile(this, object : OnDataSendToActivity {
                    override fun sendData(str: String, flag: String) {
                        try {
                            val jsonObject = JSONObject(str)

                            val Success = jsonObject.getInt("Success")
                            if (Success == 0) {
                                AlertDialogManager.showDialog(this@NoticeAddActivity, jsonObject.optString("Message"), "Ok", null, null)
                            } else {
                                if (i == 3) {
                                    attch3 = jsonObject.getString("URL")
                                    isOk = true
                                } else if (i == 1) {
                                    attch1 = jsonObject.getString("URL")
                                    if (attch2 == null && attch3 == null) {
                                        isOk = true
                                    } else if (attch2 != null) {
                                        isOk = false
                                        uploadMultipart(attch2, a, 2)
                                    }
                                } else if (i == 2) {
                                    attch2 = jsonObject.getString("URL")
                                    if (attch3 == null) {
                                        isOk = true
                                    } else {
                                        isOk = false
                                        uploadMultipart(attch3, a, 3)
                                    }
                                }
                                if (isOk)
                                    addNotice(noticeTitle.text.trim(), message.text.trim(), attch1, attch2, attch3, a as String);

//                                onBackPressed()
//                                val i = Intent(this@NoticeAddActivity, DocumentsHistoryActivity::class.java)
//                                startActivity(i)
//                                finish()
//                                overridePendingTransition(0, 0)
                            }
                        } catch (e: Exception) {
                            e.printStackTrace()
                        }

                    }
                }, "add", userDetail.optString("Institute_ID"), userDetail.optString("Staff_ID"), file)
            }
        } catch (e: Exception) {
            e.printStackTrace()
        }

    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    public override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)

        if (requestCode == PICK_PDF_REQUEST && resultCode == Activity.RESULT_OK && data != null && data.data != null) {
            if (attch1 == null) {
                if (sizeCheck(data.data)) {
                    attch1 = FilePath.getPath(this, data.data)
                    attachment1.visibility = View.VISIBLE
                    attachment1.setText(attch1)
                }
            } else if (attch2 == null) {
                attch2 = FilePath.getPath(this, data.data)
                attachment2.visibility = View.VISIBLE
                attachment2.setText(attch2)
            } else if (attch3 == null) {
                attch3 = FilePath.getPath(this, data.data)
                attachment3.setText(attch3)
                attachment3.visibility = View.VISIBLE
                attachments.visibility = View.GONE
            }
        }
    }

    private fun sizeCheck(uri: Uri?): Boolean {
        var dataSize = 0;
        var isSizeOk = false;
        var scheme = uri!!.getScheme();
        System.out.println("Scheme type " + scheme);
        if (scheme.equals(ContentResolver.SCHEME_CONTENT)) {
            try {
                var fileInputStream = getApplicationContext().getContentResolver().openInputStream(uri);
                dataSize = fileInputStream.available();
            } catch (e: Exception) {
                e.printStackTrace()
            }
            System.out.println("File size in bytes" + dataSize);

        } else if (scheme.equals(ContentResolver.SCHEME_FILE)) {
            var path = uri.getPath();
            try {
                var f = File(path);
                dataSize = f.length().toInt()
                System.out.println("File size in bytes" + dataSize);
            } catch (e: Exception) {
                e.printStackTrace()
            }

        }
        if ((Math.round((dataSize / (1024 * 1024) * 10).toDouble()) / 10) <= 3) {
            isSizeOk = true
        } else {
            isSizeOk = false
            AlertDialogManager.showDialog(this@NoticeAddActivity, "Max file size is 3 Mb", "Ok", null, null)
        }
        return isSizeOk
    }

    internal var submit_clicked = false
    override fun onRequestPermissionsResult(requestCode: Int, permissions: Array<String>, grantResults: IntArray) {
        try {
            if (grantResults.size > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                when (requestCode) {
                    MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE -> {
                        val result = Utility.checkReadMCardPermission(this@NoticeAddActivity)
                        if (result) {
                            if (submit_clicked) {
                                submitBtn.performClick()
                            } else {
                                selectDoc()
                            }
                        }
                    }
                }
            } else {
                Toast.makeText(this@NoticeAddActivity, "Permission denied", Toast.LENGTH_SHORT).show()
            }
        } catch (e: Exception) {
            e.printStackTrace()
        }

        return
        // add other cases for more permissions
    }

    private fun getFileChooserIntent(): Intent {
        val mimeTypes = arrayOf("image/*", "application/pdf")

        val intent = Intent(Intent.ACTION_GET_CONTENT)
        intent.addCategory(Intent.CATEGORY_OPENABLE)

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {
            intent.type = if (mimeTypes.size == 1) mimeTypes[0] else "*/*"
            if (mimeTypes.size > 0) {
                intent.putExtra(Intent.EXTRA_MIME_TYPES, mimeTypes)
            }
        } else {
            var mimeTypesStr = ""

            for (mimeType in mimeTypes) {
                mimeTypesStr += "$mimeType|"
            }

            intent.type = mimeTypesStr.substring(0, mimeTypesStr.length - 1)
        }

        return intent
    }

    private fun selectDoc() {
        val intent = getFileChooserIntent()
        startActivityForResult(Intent.createChooser(intent, "Select file"), PICK_PDF_REQUEST)
    }

    private fun setActionBar() {
        //Set dashboard
        setSupportActionBar(toolbar)
        toolbar.setTitle("Create Notice")
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        toolbar.setNavigationOnClickListener(View.OnClickListener {
            onBackPressed()
        })
    }

    var isChanged = false
    override fun onBackPressed() {
        val resultIntent = Intent()
        resultIntent.putExtra(commonVariables.KEY_CHANGED, isChanged)
        setResult(Activity.RESULT_OK, resultIntent)
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)

    }

    private fun fetchClasses() {
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.GET_CLASSNAME,
                Response.Listener<String> { response ->
                    try {
                        progressBar.visibility = View.GONE
                        Log.e("loginRes=>", response)
                        if (response != null && response.length > 0) {
                            val JNObject = JSONObject(response)
                            var jsonArray = JNObject.optJSONArray("Class_Details")
                            var adapter = ArrayAdapter<String>(this, android.R.layout.simple_spinner_item);
                            for (i in 0 until jsonArray.length()) {
                                adapter.add(jsonArray.getJSONObject(i).getString("Class_Name"))
                                listclassIds.add(jsonArray.getJSONObject(i).getString("Class_ID"))

                            }
                            spinnerMulti.setAdapter(adapter, false, onSelectedListener);
                            var selectedItems = BooleanArray(adapter.getCount());
                            selectedItems[0] = true; // select second item
                            spinnerMulti.setSelected(selectedItems);
                        }
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    progressBar.visibility = View.GONE
                    //Toast.makeText(this@NoticeAddActivity, error.toString(), Toast.LENGTH_LONG).show()
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                val userDetail = JSONObject(AppPreferences(this@NoticeAddActivity).retrieveUser())
                params.put("Institute_ID", userDetail.optString("Institute_ID"))
                return params
            }

        }
        App.getInstance().addToRequestQueue(stringRequest)
    }
}
