package app.student.attendance.com.teacherapp.Activities

import android.app.DatePickerDialog
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.View
import android.view.animation.AnimationUtils
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.Adapter.ReportDateAdapter
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AlertDialogManager
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.student.attendance.com.teacherapp.Utility.Utility
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_report_date.*
import org.json.JSONObject
import java.text.SimpleDateFormat
import java.util.*


class ReportDateActivity : AppCompatActivity() {
    var fromDateVal = ""
    var toDateVal = ""

    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_report_date)
            setActionBar()
            val c = Calendar.getInstance()
            val myFormat = "yyyy-MM-dd" //In which you need put here
            val sdf = SimpleDateFormat(myFormat, Locale.US)
            toDate.setText(sdf.format(c.time))

            c.add(Calendar.DAY_OF_YEAR, -15);
            fromDate.setText(sdf.format(c.time))

            fromDate.setOnClickListener(View.OnClickListener {
                val calendar = Calendar.getInstance()
                val yy = calendar.get(Calendar.YEAR)
                val mm = calendar.get(Calendar.MONTH)
                val dd = calendar.get(Calendar.DAY_OF_MONTH)
                val datePicker = DatePickerDialog(this, DatePickerDialog.OnDateSetListener { view, year, monthOfYear, dayOfMonth ->
                    val date = year.toString() + "-" + (monthOfYear + 1).toString() + "-" + dayOfMonth.toString()
                    if (!toDateVal.isEmpty() && date.compareTo(toDateVal) > 0) {
                        toDateVal = ""
                        toDate.text =""
                    }
                    fromDate.text =date
                    fromDateVal = date;

                }, yy, mm, dd)
                datePicker.getDatePicker().setMaxDate(System.currentTimeMillis() - 1000);
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
                        toDate.text =date
                        toDateVal = date;
                    }
                }, yy, mm, dd)
                datePicker.getDatePicker().setMaxDate(System.currentTimeMillis() - 1000);
                datePicker.show()
            })
            submitBtn.setOnClickListener(View.OnClickListener {
                val result = Utility.checkReadMCardPermission(this@ReportDateActivity)
                if (result) {

                    if (fromDate.text.isEmpty()) {
                        AlertDialogManager.showDialog(this, "From Date is Required", "Ok", null, null)
                    } else if (toDate.text.isEmpty()) {
                        AlertDialogManager.showDialog(this, "To Date is Required", "Ok", null, null)
                    } else {
                        dashboardAPICall()
                    }

                }
            })
            dashboardAPICall()
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun setActionBar() {
        setSupportActionBar(toolbar)
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        toolbar.setNavigationOnClickListener(View.OnClickListener {
            onBackPressed()
        })
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

    private fun dashboardAPICall() {
        try {
            ProgressDialogUtil.showDialog(this@ReportDateActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.REPORT_DATEWISE,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
                            Log.e("loginRes=>", response)

                            val JNObject = JSONObject(response)
                            val resId = R.anim.layout_animation_fall_down
                            val animation = AnimationUtils.loadLayoutAnimation(this@ReportDateActivity, resId)
                            lectureList.setLayoutAnimation(animation)
                            lectureList.layoutManager = LinearLayoutManager(this@ReportDateActivity, LinearLayoutManager.VERTICAL, false);
                            lectureList.adapter = ReportDateAdapter(JNObject.optJSONArray("Subject_Report"), this@ReportDateActivity)
                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@ReportDateActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@ReportDateActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Student_ID", userDetail.optString("Student_ID"))
                        params.put("Class_ID", userDetail.optString("Class_ID"))
                        params.put("From_Date", fromDate.text.toString())
                        params.put("To_Date", toDate.text.toString())
                    } catch (e: Exception) {
                    }
                    return params
                }

            }
            App.getInstance().addToRequestQueue(stringRequest)
        } catch (e: Exception) {
        }
    }

}
