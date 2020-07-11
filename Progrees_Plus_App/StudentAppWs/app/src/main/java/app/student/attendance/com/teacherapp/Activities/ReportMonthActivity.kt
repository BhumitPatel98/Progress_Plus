package app.student.attendance.com.teacherapp.Activities

import android.app.Dialog
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.View
import android.view.animation.AnimationUtils
import android.widget.Button
import android.widget.NumberPicker
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.Adapter.ReportMonthAdapter
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_report_month.*
import org.json.JSONObject
import java.util.*


class ReportMonthActivity : AppCompatActivity() {
    var arrMonth = arrayOf("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec")
    var arrYear = arrayOf("2018", "2019", "2020", "2021", "2022")


    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_report_month)
            setActionBar()

            val c = Calendar.getInstance()
            val yearVal = c.get(Calendar.YEAR)
            val monthVal = c.get(Calendar.MONTH)
            month.setText(arrMonth.get(monthVal))
            year.setText(yearVal.toString())

            year.setOnClickListener(View.OnClickListener() {
                showYear()
            })
            month.setOnClickListener(View.OnClickListener() {
                show()
            })
            dashboardAPICall()
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }

    fun show() {

        try {
            val d = Dialog(this@ReportMonthActivity)
            d.setTitle("Select Month")
            d.setContentView(R.layout.dialog_month)
            val b1 = d.findViewById(R.id.button1) as Button
            val b2 = d.findViewById(R.id.button2) as Button
            val np = d.findViewById(R.id.numberPicker1) as NumberPicker
            np.setMinValue(0)
            np.setMaxValue(11)
            np.value = getValMonth()
            np.setDisplayedValues(arrMonth)
            np.wrapSelectorWheel = false
            b1.setOnClickListener(View.OnClickListener() {
                month.text =arrMonth.get(np.value)
                dashboardAPICall()
                d.dismiss()
            })
            b2.setOnClickListener(View.OnClickListener() {
                d.dismiss()
            })
            d.show()
        } catch (e: Exception) {
        }
    }
    fun showYear() {
        try {
            val d = Dialog(this@ReportMonthActivity)
            d.setTitle("Select Year")
            d.setContentView(R.layout.dialog_month)
            val b1 = d.findViewById(R.id.button1) as Button
            val b2 = d.findViewById(R.id.button2) as Button
            val np = d.findViewById(R.id.numberPicker1) as NumberPicker
            np.setMinValue(0)
            np.setMaxValue(4)
            np.value = getValYear()
            np.setDisplayedValues(arrYear)
            np.wrapSelectorWheel = false
            b1.setOnClickListener(View.OnClickListener() {
                year.text =arrYear.get(np.value)
                dashboardAPICall()
                d.dismiss()
            })
            b2.setOnClickListener(View.OnClickListener() {
                d.dismiss()
            })
            d.show()
        } catch (e: Exception) {
        }
    }

    private fun getValYear(): Int {
        val valyear = year.text
        var i = 0
        for (item in arrYear) {
            if (item.equals(valyear))
                return i;
            else
                i++
        }
        return 0
    }

    private fun getValMonth(): Int {
        val valyear = month.text
        var i = 0
        for (item in arrMonth) {
            if (item.equals(valyear))
                return i;
            else
                i++
        }
        return 0
    }



    private fun setActionBar() {
        //Set dashboard
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
            ProgressDialogUtil.showDialog(this@ReportMonthActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.REPORT_MONTHWISE,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
                            Log.e("loginRes=>", response)

                            val JNObject = JSONObject(response)
                            val resId = R.anim.layout_animation_fall_down
                            val animation = AnimationUtils.loadLayoutAnimation(this@ReportMonthActivity, resId)
                            lectureList.setLayoutAnimation(animation)
                            lectureList.layoutManager = LinearLayoutManager(this@ReportMonthActivity, LinearLayoutManager.VERTICAL, false);
                            lectureList.adapter = ReportMonthAdapter(JNObject.optJSONArray("Subject_Report"), this@ReportMonthActivity)
                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@ReportMonthActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@ReportMonthActivity).retrieveUser())
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
