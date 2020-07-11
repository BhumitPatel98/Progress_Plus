package app.student.attendance.com.teacherapp.Activities

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.View
import android.view.animation.AnimationUtils
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.Adapter.ReportStudentDetailAdapter
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_report_student_detail.*
import org.json.JSONObject


class ReportStudentDetailActivity : AppCompatActivity() {
    var fromDate: String = ""
    var day: String = ""
    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_report_student_detail)
            fromDate = intent.extras.getString("DATE")
            day = intent.extras.getString("DAY")
            setActionBar()
            dashboardAPICall()

            from.text =fromDate
            to.text =day
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun setActionBar() {
        //Set dashboard
        setSupportActionBar(toolbar)
        toolbar.setTitle("MonthWise Report")
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
            ProgressDialogUtil.showDialog(this@ReportStudentDetailActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.REPORT_STUDENT_DETAIL_LIST,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
                            Log.e("loginRes=>", response)

                            val JNObject = JSONObject(response)
                            from.text =JNObject!!.optString("Date")
                            to.text =JNObject!!.optString("Day")
                            val resId = R.anim.layout_animation_fall_down
                            val animation = AnimationUtils.loadLayoutAnimation(this@ReportStudentDetailActivity, resId)
                            lectureList.setLayoutAnimation(animation)
                            lectureList.layoutManager = LinearLayoutManager(this@ReportStudentDetailActivity, LinearLayoutManager.VERTICAL, false);
                            var array = JNObject.optJSONArray("Subject_Report")
                            if (array.length() > 0)
                                lectureList.adapter = ReportStudentDetailAdapter(array, this@ReportStudentDetailActivity)
                            else
                                noItemFound.visibility = View.VISIBLE
                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@ReportStudentDetailActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@ReportStudentDetailActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Student_ID", userDetail.optString("Student_ID"))
                        params.put("Class_ID", userDetail.optString("Class_ID"))
                        params.put("Date", fromDate)
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
