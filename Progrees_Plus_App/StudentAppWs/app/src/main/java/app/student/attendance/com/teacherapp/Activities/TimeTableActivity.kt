package app.student.attendance.com.teacherapp.Activities

import android.os.Bundle
import android.support.v4.app.Fragment
import android.support.v4.app.FragmentManager
import android.support.v4.app.FragmentPagerAdapter
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.View
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.student.attendance.com.teacherapp.fragments.TimetableFragment
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_timetable.*
import org.json.JSONObject


class TimeTableActivity : AppCompatActivity() {

    val days = Array<String>(7, { "Sunday" });
    var tableResponse = JSONObject()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_timetable)
        setActionBar()
        days[0] = "Mon"
        days[1] = "Tue"
        days[2] = "Wed"
        days[3] = "Thu"
        days[4] = "Fri"
        days[5] = "Sat"
        days[6] = "Sun"
        timetableAPICall()
    }


    private fun setActionBar() {
        //Set dashboard
        setSupportActionBar(toolbar)
        toolbar.setTitle("Time Table")
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        toolbar.setNavigationOnClickListener(View.OnClickListener {
            onBackPressed()
        })
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

    private fun timetableAPICall() {
        ProgressDialogUtil.showDialog(this@TimeTableActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.TIMETABLE,
                Response.Listener<String> { response ->
                    try {
                        ProgressDialogUtil.hideDialog()
                        Log.e("loginRes=>", response)
                        tableResponse = JSONObject(response)
                        timeTableViewPager.adapter = PageAdapter(supportFragmentManager)
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    try {
                        Toast.makeText(this@TimeTableActivity, error.toString(), Toast.LENGTH_LONG).show()
                        ProgressDialogUtil.hideDialog();
                    } catch (e: Exception) {
                    }
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                val userDetail = JSONObject(AppPreferences(this@TimeTableActivity).retrieveUser())
                params.put("Institute_ID", userDetail.optString("Institute_ID"))
                params.put("Class_ID", userDetail.optString("Class_ID"))
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    inner class PageAdapter(fm: FragmentManager) : FragmentPagerAdapter(fm) {

        override fun getItem(position: Int): Fragment? {
            when (position) {
                0 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Monday"))
                1 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Tuesday"))
                2 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Wednesday"))
                3 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Thursday"))
                4 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Friday"))
                5 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Saturday"))
                6 ->
                    return TimetableFragment.getInstance(tableResponse.optJSONArray("Sunday"))
            }
            return null
        }

        override fun getCount(): Int {
            return 7
        }

        override fun getPageTitle(position: Int): CharSequence? {
            return days[position]
        }
    }
}
