package app.student.attendance.com.teacherapp.Activities

import android.content.Intent
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.View
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.applandeo.materialcalendarview.EventDay
import com.applandeo.materialcalendarview.listeners.OnDayClickListener
import kotlinx.android.synthetic.main.activity_report_student.*
import org.json.JSONObject
import java.text.SimpleDateFormat
import java.util.*
import kotlin.collections.ArrayList


class ReportStudentActivity : AppCompatActivity() {
    var arrMonth = arrayOf("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec")

    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_report_student)
            setActionBar()

            val c = Calendar.getInstance()
            val yearVal = c.get(Calendar.YEAR)
            val monthVal = c.get(Calendar.MONTH)
            month.setText(arrMonth.get(monthVal))
            year.setText(yearVal.toString())

            calendarView.setDate(Date())
            calendarView.setOnForwardPageChangeListener {
                val cal = calendarView.currentPageDate
                val yearVal = cal.get(Calendar.YEAR)
                val monthVal = cal.get(Calendar.MONTH)
                month.setText(arrMonth.get(monthVal))
                year.setText(yearVal.toString())
                dashboardAPICall()
            }
            calendarView.setOnPreviousPageChangeListener {
                val cal = calendarView.currentPageDate
                val yearVal = cal.get(Calendar.YEAR)
                val monthVal = cal.get(Calendar.MONTH)
                month.setText(arrMonth.get(monthVal))
                year.setText(yearVal.toString())
                dashboardAPICall()
            }

            calendarView.setOnDayClickListener(OnDayClickListener() {
                try {
                    var cal = calendarView.firstSelectedDate
                    var intent = Intent(this@ReportStudentActivity, ReportStudentDetailActivity::class.java)
                    val myFormat = "yyyy-MM-dd"
                    var sdf = SimpleDateFormat(myFormat, Locale.US)
                    intent.putExtra("DATE", sdf.format(cal.time))
                    sdf = SimpleDateFormat("EEEE")
                    intent.putExtra("DAY", sdf.format(cal.time))
                    startActivity(intent)
                } catch (e: Exception) {
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
            ProgressDialogUtil.showDialog(this@ReportStudentActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.REPORT_STUDENT_LIST,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
                            Log.e("loginRes=>", response)

                            val JNObject = JSONObject(response)
                            var jarr = JNObject.optJSONArray("Subject_Report")
                            val events = ArrayList<EventDay>()
                            for (i in 0..(jarr.length() - 1)) {
                                val item = jarr.getJSONObject(i)
                                var c = Calendar.getInstance()
                                var sdf = SimpleDateFormat("yyyy-MM-dd")
                                var dateInString = item.optString("Date")
                                var date = sdf.parse(dateInString)
                                c.time = date
                                var icon = R.drawable.ic_circle_holi
                                if (item.optString("Status").equals("Full"))
                                    icon = R.drawable.ic_circle_full
                                else if (item.optString("Status").equals("Absent"))
                                    icon = R.drawable.ic_circle_ab
                                else if (item.optString("Status").equals("Partial"))
                                    icon = R.drawable.ic_circle_par
                                events.add(EventDay(c, icon))
                            }
                            calendarView.setEvents(events)

                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@ReportStudentActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@ReportStudentActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Student_ID", userDetail.optString("Student_ID"))
                        params.put("Class_ID", userDetail.optString("Class_ID"))
                        params.put("Month", month.text.toString())
                        params.put("Year", year.text.toString())
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
