package app.student.attendance.com.teacherapp.Activities

import android.app.Activity
import android.content.Intent
import android.graphics.Bitmap
import android.os.Build
import android.os.Bundle
import android.support.annotation.RequiresApi
import android.support.v7.app.ActionBarDrawerToggle
import android.support.v7.app.AppCompatActivity
import android.util.Log
import android.view.View
import android.widget.ImageView
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.student.attendance.com.teacherapp.Utility.commonMethods
import app.student.attendance.com.teacherapp.Utility.commonVariables
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.ImageRequest
import com.android.volley.toolbox.StringRequest
import com.applandeo.materialcalendarview.EventDay
import com.github.mikephil.charting.components.YAxis
import com.github.mikephil.charting.data.BarData
import com.github.mikephil.charting.data.BarDataSet
import com.github.mikephil.charting.data.BarEntry
import com.github.mikephil.charting.data.Entry
import kotlinx.android.synthetic.main.activity_main.*
import org.json.JSONObject
import java.text.SimpleDateFormat
import java.util.*


class MainActivity : AppCompatActivity() {
    var entries = ArrayList<Entry>()
    var PieEntryLabels = ArrayList<String>()
    val entries2 = ArrayList<BarEntry>()
    val labels = ArrayList<String>()
    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_main)
            setupActionBar()
            setHeaderData()

//            tv_school_name!!.setOnClickListener(View.OnClickListener {
//                openProfile()
//            })
//            tv_student_name!!.setOnClickListener(View.OnClickListener {
//                openProfile()
//            })
//            profile_image2!!.setOnClickListener(View.OnClickListener {
//                openProfile()
//            })

            action_dashboard.setOnClickListener(View.OnClickListener {
                drawer_layout.closeDrawers()
            })
            action_timeTable.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, TimeTableActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_noticeBoard.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, NoticeboardActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_rep_datewise.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, ReportDateActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_rep_monthwise.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, ReportMonthActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_report.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, ReportStudentActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_change_pass.setOnClickListener(View.OnClickListener {
                startActivity(Intent(this@MainActivity, ChangePasswordActivity::class.java))
                drawer_layout.closeDrawers()
            })
            action_logout.setOnClickListener(View.OnClickListener {
                commonMethods.logout(this)
                drawer_layout.closeDrawers()
            })
            action_sub_report.setOnClickListener(View.OnClickListener {
                if (action_rep_datewise.visibility == View.VISIBLE) {
                    action_rep_datewise.visibility = View.GONE
                    action_rep_monthwise.visibility = View.GONE
                    down.rotation = 0F
                } else {
                    action_rep_datewise.visibility = View.VISIBLE
                    action_rep_monthwise.visibility = View.VISIBLE
                    down.rotation = 180F
                }
            })

            AddValuesToPIEENTRY()
            AddValuesToPieEntryLabels()
//            var pieDataSet = PieDataSet(entries, "")
//            var pieData = PieData(PieEntryLabels, pieDataSet)
//            pieDataSet.setColors(ColorTemplate.COLORFUL_COLORS)
//            chart1.setData(pieData)
//            chart1.animateY(3000)

            dashboardAPICall()
            speedView.unitTextSize
            speedView.speedTo(50F);
            speedView.speedTo(50F, 4000);
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    private fun dashboardAPICall() {
        try {
            ProgressDialogUtil.showDialog(this@MainActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.REPORT_DATEWISE,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            Log.e("loginRes=>", response)

                            val JNObject = JSONObject(response)
                            var jarr = JNObject.optJSONArray("Subject_Report")
                            val events = ArrayList<EventDay>()
                            for (i in 0..(jarr.length() - 1)) {
                                val item = jarr.getJSONObject(i)
                                labels.add(item.optString("Subject_Name"))
                                var valu = 0F
                                if (item.optString("Attendance").equals("Present"))
                                    valu = 1F
                                entries2.add(BarEntry(valu, i))
                            }
                            val bardataset = BarDataSet(entries2, "Cells")
                            var data = BarData(labels, bardataset)
                            val numbers: IntArray = intArrayOf(R.color.present, R.color.present)
                            bardataset.setColors(numbers, this@MainActivity);
                            barChart.setData(data)
                            barChart.setVisibleYRangeMaximum(3F, YAxis.AxisDependency.LEFT)
                            barChart.setDescription("")
                            barChart.invalidate()
                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@MainActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@MainActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Student_ID", userDetail.optString("Student_ID"))
                        params.put("Class_ID", userDetail.optString("Class_ID"))
                        val c = Calendar.getInstance()
                        val myFormat = "yyyy-MM-dd" //In which you need put here
                        val sdf = SimpleDateFormat(myFormat, Locale.US)
                        //   params.put("Date", sdf.format(c.time))
                        params.put("Date", "2018-06-27")
                    } catch (e: Exception) {
                    }
                    return params
                }

            }
            App.getInstance().addToRequestQueue(stringRequest)
        } catch (e: Exception) {
        }
    }

    fun AddValuesToPIEENTRY() {

        entries.add(BarEntry(2f, 0))
        entries.add(BarEntry(4f, 1))
        entries.add(BarEntry(6f, 2))
        entries.add(BarEntry(8f, 3))
        entries.add(BarEntry(7f, 4))
        entries.add(BarEntry(3f, 5))

    }

    fun AddValuesToPieEntryLabels() {

        PieEntryLabels.add("January")
        PieEntryLabels.add("February")
        PieEntryLabels.add("March")
        PieEntryLabels.add("April")
        PieEntryLabels.add("May")
        PieEntryLabels.add("June")

    }

    private fun openProfile() {
        try {
            var intent = Intent(this@MainActivity, ProfileActivity::class.java)
            startActivityForResult(intent, commonVariables.REQUEST_CHANGE)
            overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
            drawer_layout.closeDrawers()
        } catch (e: Exception) {
        }
    }

    private fun loadImage(mImageURLString: String?) {
        var imageRequest = ImageRequest(
                mImageURLString, // Image URL
                Response.Listener<Bitmap> { response ->
                    try {
                        profile_image2!!.setImageBitmap(response)
                    } catch (e: Exception) {
                    }
                },
                0,
                0,
                ImageView.ScaleType.CENTER_CROP, // Image scale type
                Bitmap.Config.RGB_565, //Image decode configuration
                Response.ErrorListener { error ->
                    Toast.makeText(this@MainActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog()
                }
        )

        App.getInstance().addToRequestQueue(imageRequest)

    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    public override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (resultCode == Activity.RESULT_OK && data != null) {
            if (data.getBooleanExtra(commonVariables.KEY_CHANGED, false)) {
                setHeaderData()
            }
        }
    }

    private fun setHeaderData() {
        val userDetail = JSONObject(AppPreferences(this@MainActivity).retrieveUser())
        loadImage(userDetail.optString("Photo"))
        tv_student_name!!.setText(userDetail.optString("First_Name") + " " + userDetail.optString("Last_Name"))
        tv_school_name!!.setText(userDetail.optString("Institute_Name"))
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

    private fun setupActionBar() {
        setSupportActionBar(toolbar)
        supportActionBar!!.setTitle("")
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        supportActionBar!!.setDisplayShowHomeEnabled(true)
        supportActionBar!!.setHomeButtonEnabled(true)

        val drawerToggle = ActionBarDrawerToggle(
                this,
                drawer_layout,
                toolbar,
                R.string.drawer_open,
                R.string.drawer_close)
        drawer_layout.setDrawerListener(drawerToggle)
        drawerToggle.isDrawerIndicatorEnabled = true
        drawerToggle.syncState()
    }
}

