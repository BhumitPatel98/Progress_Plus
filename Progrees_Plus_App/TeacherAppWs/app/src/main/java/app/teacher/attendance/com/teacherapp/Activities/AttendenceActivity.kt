package app.teacher.attendance.com.teacherapp.Activities

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.MenuItem
import android.view.View
import android.widget.CompoundButton
import android.widget.Toast
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.Adapter.AttendenceAdapter
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AppPreferences
import app.teacher.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.teacher.attendance.com.teacherapp.Utility.commonVariables
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_attendence.*
import org.json.JSONObject

class AttendenceActivity : AppCompatActivity() {
    var studList: JSONObject? = null
    var adap: AttendenceAdapter? = null
    var jsonOriginal: JSONObject? = null
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_attendence)
        setActionBar()
        studentListAPICall()
        submitAttendance.setOnClickListener(View.OnClickListener {
            recordAttendanceAPICall()
        })
        val jsonObject = JSONObject(intent.getStringExtra("CLASS_DETAIL"))
        class_name.text = jsonObject.optString("Class_Name")
        subject.text = jsonObject.optString("Subject_Name")
        time.text = jsonObject.optString("Timing")
        studentCount.text = jsonObject.optString("No_Of_Student")
        if (jsonObject.optString("Sms").equals("Yes"))
            isSmsToParent.visibility = View.GONE

        cb_all.setOnCheckedChangeListener(CompoundButton.OnCheckedChangeListener { button, isChecked ->

            if (cb_all.isChecked) {
                jsonOriginal = studList
                studList = JSONObject(studList.toString().replace("Absent", "Present"))
                adap = AttendenceAdapter(studList!!.optJSONArray("Student_List"))
                lectureList.adapter = adap
            } else {
                studList = jsonOriginal
                adap = AttendenceAdapter(studList!!.optJSONArray("Student_List"))
                lectureList.adapter = adap
            }
        })
    }


    private fun setActionBar() {
        //Set dashboard
        setSupportActionBar(toolbar)
        toolbar.setTitle("Attendence")
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

    override fun onOptionsItemSelected(item: MenuItem?): Boolean {
        val b = super.onOptionsItemSelected(item)
        if (item!!.itemId == R.id.action_timeTable)
            startActivity(Intent(this@AttendenceActivity, TimeTableActivity::class.java))
        return b
    }

    private fun studentListAPICall() {
        ProgressDialogUtil.showDialog(this@AttendenceActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.STUDENT_LIST,
                Response.Listener<String> { response ->
                    ProgressDialogUtil.hideDialog()
                    progressBar.visibility = View.GONE
                    Log.e("loginRes=>", response)
                    studList = JSONObject(response)

                    lectureList.layoutManager = LinearLayoutManager(this@AttendenceActivity, LinearLayoutManager.VERTICAL, false);
                    lectureList.setHasFixedSize(true)
                    lectureList.setNestedScrollingEnabled(false);
                    adap = AttendenceAdapter(studList!!.optJSONArray("Student_List"))
                    lectureList.adapter = adap
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@AttendenceActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val classDetail = JSONObject(intent.getStringExtra("CLASS_DETAIL"))
                    val usersDetail = JSONObject(AppPreferences(this@AttendenceActivity).retrieveUser())
                    var stTake = classDetail.optString("Attendance_Taken");
                    if (stTake.isEmpty())
                        stTake = "No"
                    params.put("Institute_ID", usersDetail.optString("Institute_ID"))
                    params.put("Class_ID", classDetail.optString("Class_ID"))
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    params.put("Subject_ID", classDetail.optString("Subject_ID"))
                    params.put("Batch_Name", classDetail.optString("Batch_Name"))
                    params.put("Lecture", classDetail.optString("Lecture"))
                    params.put("Attendance_taken", stTake)
                    params.put("Attendance_ID", classDetail.optString("Attendance_ID"))
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    private fun recordAttendanceAPICall() {
        isChanged = true
        ProgressDialogUtil.showDialog(this@AttendenceActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.SUBMIT_ATTENDANCE,
                Response.Listener<String> { response ->
                    ProgressDialogUtil.hideDialog()
                    progressBar.visibility = View.GONE
                    Log.e("loginRes=>", response)
                    Toast.makeText(this@AttendenceActivity, "Attendance Submitted successfully", Toast.LENGTH_SHORT).show()
                    onBackPressed()
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@AttendenceActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val classDetail = JSONObject(intent.getStringExtra("CLASS_DETAIL"))
                    val usersDetail = JSONObject(AppPreferences(this@AttendenceActivity).retrieveUser())

                    studList!!.put("Institute_ID", usersDetail.optString("Institute_ID"))
                    studList!!.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    studList!!.put("Class_ID", classDetail.optString("Class_ID"))
                    studList!!.put("Subject_ID", classDetail.optString("Subject_ID"))
                    studList!!.put("Batch_Name", classDetail.optString("Batch_Name"))
                    studList!!.put("Lecture", classDetail.optString("Lecture"))
                    studList!!.put("Attendance_taken", classDetail.optString("Attendance_Taken"))
                    studList!!.put("Attendance_ID", classDetail.optString("Attendance_ID"))
                    if (isSmsToParent.isChecked)
                        studList!!.put("Sms", "Yes")
                    else
                        studList!!.put("Sms", "No")
                    studList!!.put("Student_List", adap!!.dataList)
                    params.put("Attendance_List", studList.toString())

                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }
}