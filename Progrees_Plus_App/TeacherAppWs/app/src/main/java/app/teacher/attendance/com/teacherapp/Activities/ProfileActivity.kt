package app.student.attendance.com.teacherapp.Activities

import android.app.Activity
import android.app.DatePickerDialog
import android.app.Dialog
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.graphics.BitmapFactory
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.net.Uri
import android.os.Bundle
import android.os.Environment
import android.provider.MediaStore
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.Toolbar
import android.util.Log
import android.view.MenuItem
import android.view.View
import android.view.Window
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.API.ApiSettings.UploadFile
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.*
import app.teacher.attendance.com.teacherapp.Utility.Utility.MY_PERMISSIONS_CAMERA
import app.teacher.attendance.com.teacherapp.Utility.Utility.MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.ImageRequest
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_profile.*
import org.json.JSONObject
import java.io.ByteArrayOutputStream
import java.io.File
import java.io.FileOutputStream
import java.text.SimpleDateFormat
import java.util.*

class ProfileActivity : AppCompatActivity() {

    private var url = ""
    private val SELECT_FILE = 1
    private val REQUEST_CAMERA = 2
    lateinit var dialog: Dialog
    val TEMP_PHOTO_FILE_NAME = ".temp_photo.png"
    lateinit var mFileTemp: File

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        try {
            try {
                val state = Environment.getExternalStorageState()
                if (Environment.MEDIA_MOUNTED == state) {
                    mFileTemp = File(Environment.getExternalStorageDirectory(), TEMP_PHOTO_FILE_NAME)
                } else {
                    mFileTemp = File(filesDir, TEMP_PHOTO_FILE_NAME)
                }
            } catch (e: Exception) {
                e.printStackTrace()
            }

            setContentView(R.layout.activity_profile)
            val toolbar = findViewById(R.id.toolbar) as Toolbar
            setSupportActionBar(toolbar)

            supportActionBar!!.setDisplayShowHomeEnabled(true)
            supportActionBar!!.setDisplayHomeAsUpEnabled(true)
            supportActionBar!!.setDisplayShowTitleEnabled(false)

            ll_bdate.setOnClickListener(View.OnClickListener {
                myCalendar = Calendar.getInstance()
                DatePickerDialog(this@ProfileActivity, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show()
            })
            edt_birth_date.setOnClickListener(View.OnClickListener {
                myCalendar = Calendar.getInstance()
                DatePickerDialog(this@ProfileActivity, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show()
            })
            profileimg.setOnClickListener(View.OnClickListener { selectImage() })
            btn_submit.setOnClickListener(View.OnClickListener { callProfileMethod() })
//            tv_changeprofile.setOnClickListener(View.OnClickListener { selectImage() })
            callProfileGetDataMethod()
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }

    var isChanged = false
    var isPicChanged = false
    override fun onBackPressed() {
        val resultIntent = Intent()
        resultIntent.putExtra(commonVariables.KEY_PROF_CHANGED, isChanged)
        setResult(Activity.RESULT_OK, resultIntent)
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)

    }


    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        when (item.itemId) {
            android.R.id.home -> {
                onBackPressed()
                return true
            }
            else -> return super.onOptionsItemSelected(item)
        }
    }


    private fun updateLabel() {

        val myFormat = "dd-MM-yyyy" //In which you need put here
        val sdf = SimpleDateFormat(myFormat, Locale.US)
        edt_birth_date.setText(sdf.format(myCalendar.time))

    }

    internal lateinit var myCalendar: Calendar
    internal var date: DatePickerDialog.OnDateSetListener = DatePickerDialog.OnDateSetListener { view, year, monthOfYear, dayOfMonth ->
        try {
            myCalendar.set(Calendar.YEAR, year)
            myCalendar.set(Calendar.MONTH, monthOfYear)
            myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth)
            updateLabel()
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun selectImage() {

        try {
            dialog = Dialog(this)
            dialog.requestWindowFeature(Window.FEATURE_NO_TITLE)
            dialog.setContentView(R.layout.dialog_gall_cams)
            dialog.setCanceledOnTouchOutside(true)
            dialog.setTitle(null)
            dialog.window!!.setBackgroundDrawable(ColorDrawable(Color.TRANSPARENT))
            // dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
            val bGallery1 = dialog.findViewById<TextView>(R.id.tv_gallery)
            val bCamera1 = dialog.findViewById<TextView>(R.id.tv_take_photo)
            val bCancel = dialog.findViewById<TextView>(R.id.tv_cancel)
            bGallery1.setOnClickListener(View.OnClickListener {
                try {
                    val result = Utility.checkReadMCardPermission(this@ProfileActivity)
                    if (result)
                        galleryIntent()
                } catch (e: Exception) {

                }

                dialog.dismiss()
            })
            bCamera1.setOnClickListener(View.OnClickListener {
                try {
                    var result = Utility.checkCameraPermission(this@ProfileActivity)
                    if (result) {
                        result = Utility.checkReadMCardPermission(this@ProfileActivity)
                        if (result)
                            cameraIntent()
                    }
                } catch (e: Exception) {
                    e.printStackTrace()
                }

                dialog.dismiss()
            })
            bCancel.setOnClickListener(View.OnClickListener { dialog.dismiss() })
            dialog.setOnCancelListener { dialog -> dialog.dismiss() }
            dialog.show()
        } catch (e: Exception) {
            e.printStackTrace()
        }

    }

    private fun galleryIntent() {
        try {
            val photoPickerIntent = Intent(Intent.ACTION_PICK)
            photoPickerIntent.type = "image/*"
            startActivityForResult(photoPickerIntent, SELECT_FILE)
            overridePendingTransition(0, 0)
        } catch (e: Exception) {

        }

    }

    private fun cameraIntent() {
        try {
            val intent = Intent(MediaStore.ACTION_IMAGE_CAPTURE)
            var mImageCaptureUri: Uri? = null
            val state = Environment.getExternalStorageState()
            if (Environment.MEDIA_MOUNTED == state) {
                mImageCaptureUri = commonMethods.getUriFromFile(mFileTemp, applicationContext)
            } else {
                mImageCaptureUri = InternalStorageContentProvider.CONTENT_URI
            }
            intent.putExtra(MediaStore.EXTRA_OUTPUT, mImageCaptureUri)
            intent.putExtra("return-data", true)
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP)
            startActivityForResult(intent, REQUEST_CAMERA)

            overridePendingTransition(0, 0)
        } catch (e: Exception) {
            e.printStackTrace()
        }

    }

    internal var isForCamera: Boolean = false

    override fun onRequestPermissionsResult(requestCode: Int, permissions: Array<String>, grantResults: IntArray) {
        try {
            if (grantResults.size > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                when (requestCode) {
                    MY_PERMISSIONS_CAMERA -> {
                        if (Utility.checkReadMCardPermission(this@ProfileActivity)) {
                            isForCamera = false
                            cameraIntent()
                        } else
                            isForCamera = true
                    }
                    MY_PERMISSIONS_REQUEST_READ_EXTERNAL_STORAGE -> {
                        if (isForCamera)
                            cameraIntent()
                        else
                            galleryIntent()
                    }
                }
            } else {
                Toast.makeText(this@ProfileActivity, "Permission denied to scan document", Toast.LENGTH_SHORT).show()
            }
        } catch (e: Exception) {
            e.printStackTrace()
        }

        return
        // add other cases for more permissions
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        try {
            if (resultCode == Activity.RESULT_OK) {
                if (requestCode == SELECT_FILE)
                    try {
                        try {
                            val inputStream = contentResolver.openInputStream(data!!.data!!)
                            val fileOutputStream = FileOutputStream(mFileTemp)
                            commonMethods.copyStream(inputStream!!, fileOutputStream)
                            fileOutputStream.close()
                            inputStream.close()
                            var options = BitmapFactory.Options();
                            options.inSampleSize = 2;
                            val bitmap1 = BitmapFactory.decodeFile(mFileTemp.path, options)
                            if (bitmap1 != null) {
                                useBitmap(bitmap1)
                            }

                        } catch (e: Exception) {
                            e.printStackTrace()
                        }

                    } catch (e: Exception) {
                        e.printStackTrace()
                    }
                else if (requestCode == REQUEST_CAMERA) {
                    val bitmap1 = BitmapFactory.decodeFile(mFileTemp.path)
                    if (bitmap1 != null) {
                        useBitmap(bitmap1)
                    }
                }
            }
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun useBitmap(bm: Bitmap) {
        try {
            val os = ByteArrayOutputStream()
            bm.compress(Bitmap.CompressFormat.PNG, 30, os)
            os.close()
            profileimg.setImageBitmap(bm)
            isPicChanged = true
            btn_submit.visibility = View.VISIBLE
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun callProfileMethod() {
        try {
            if (isPicChanged)
                uploadMultipart(mFileTemp.path)
            else
                updateProfileAPI(null)
        } catch (e: Exception) {
        }
    }

    fun uploadMultipart(path: String?) {
        try {
            if (path == null) {
                Toast.makeText(this, "Please move your file to internal storage and retry", Toast.LENGTH_LONG).show()
            } else {
                val file = File(path)

                val userDetail = JSONObject(AppPreferences(this@ProfileActivity).retrieveUser())

                UploadFile(this, object : OnDataSendToActivity {
                    override fun sendData(str: String, flag: String) {
                        try {
                            val jsonObject = JSONObject(str)
                            val Success = jsonObject.getInt("Success")
                            if (Success == 0) {
                                AlertDialogManager.showDialog(this@ProfileActivity, jsonObject.optString("Message"), "Ok", null, null)
                            } else {
                                var urlUploaded = jsonObject.optString("URL")
                                updateProfileAPI(urlUploaded)
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

    private fun updateProfileAPI(urlUploaded: String?) {

        isChanged = true
        ProgressDialogUtil.showDialog(this@ProfileActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.STUDENT_EDIT_PROFILE,
                Response.Listener<String> { response ->
                    try {
                        AppPreferences(this@ProfileActivity).storeUser(response)
                        ProgressDialogUtil.hideDialog()
                        val jsonObject = JSONObject(response)
                        Log.e("loginRes=>", response)
                        val runner = Runnable { onBackPressed() }
                        AlertDialogManager.showDialog(this@ProfileActivity, "Profile updated successfully", "Ok", null, runner)
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@ProfileActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    var gen = "Male"
                    if (rb_female.isChecked)
                        gen = "Female"
                    val usersDetail = JSONObject(AppPreferences(this@ProfileActivity).retrieveUser())
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    params.put("First_Name", edt_first_name.text.toString())
                    params.put("Middle_Name", edt_middle_name.text.toString())
                    params.put("Last_Name", edt_last_name.text.toString())
                    params.put("Email", edt_email.text.toString())
                    params.put("Mobile", edt_mobileno.text.toString())
                    params.put("Gender", gen)
                    params.put("Birthdate", edt_birth_date.text.toString())
                    params.put("Address", edt_address.text.toString())
                    params.put("City", edt_city.text.toString())
                    params.put("State", edt_state.text.toString())
                    params.put("Pincode", edt_pincode.text.toString())
                    params.put("Designation", edt_designation.text.toString())
                    params.put("Joining_Date", edt_joi_date.text.toString())
                    params.put("Experience", edt_exp.text.toString())
                    params.put("Education", edt_edu.text.toString())
                    if (urlUploaded != null)
                        params.put("Photo", urlUploaded)
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    private fun callProfileGetDataMethod() {
        ProgressDialogUtil.showDialog(this@ProfileActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.STUDENT_GET_PROFILE,
                Response.Listener<String> { response ->
                    try {
                        ProgressDialogUtil.hideDialog()
                        Log.e("loginRes=>", response)
                        var jsonObject = JSONObject(response)
                        AppPreferences(this@ProfileActivity).storeUser(response)
                        setProfile(jsonObject)
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                 //   Toast.makeText(this@ProfileActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog()
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val usersDetail = JSONObject(AppPreferences(this@ProfileActivity).retrieveUser())
                    params.put("Institute_ID", usersDetail.optString("Institute_ID"))
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    private fun setProfile(jsonObject: JSONObject) {
        try {
            edt_first_name.setText(jsonObject.optString("First_Name"))
            edt_middle_name.setText(jsonObject.optString("Middle_Name"))
            edt_last_name.setText(jsonObject.optString("Last_Name"))
            edt_email.setText(jsonObject.optString("Student_Email"))
            edt_mobileno.setText(jsonObject.optString("Student_Mobile"))
            edt_address.setText(jsonObject.optString("Address"))
            edt_city.setText(jsonObject.optString("City"))
            edt_state.setText(jsonObject.optString("State"))
            edt_pincode.setText(jsonObject.optString("Pincode"))
            edt_birth_date.setText(jsonObject.optString("Birthdate"))
            edt_designation.setText(jsonObject.optString("Designation"))
            edt_joi_date.setText(jsonObject.optString("Joining_date"))
            edt_exp.setText(jsonObject.optString("experience"))
            edt_edu.setText(jsonObject.optString("Education"))

            url = jsonObject.optString("Photo")
            if (url.isEmpty()) {
                profileimg.setImageResource(R.drawable.profile_image)
            } else {
                loadImage(url);
            }
            if (jsonObject.optString("Gender").equals("Female"))
                rb_female.setChecked(true);
        } catch (e: Exception) {
        }
    }

    private fun loadImage(mImageURLString: String?) {
        var imageRequest = ImageRequest(
                mImageURLString, // Image URL
                Response.Listener<Bitmap> { response ->
                    try {
                        profileimg.setImageBitmap(response);
                    } catch (e: Exception) {
                    }
                },
                0,
                0,
                ImageView.ScaleType.CENTER_CROP, // Image scale type
                Bitmap.Config.RGB_565, //Image decode configuration
                Response.ErrorListener { error ->
                    //Toast.makeText(this@ProfileActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }
        );

        App.getInstance().addToRequestQueue(imageRequest)

    }

    override fun onResume() {
        super.onResume()
        commonMethods.hasActiveInternetConnection(this)
    }

}
