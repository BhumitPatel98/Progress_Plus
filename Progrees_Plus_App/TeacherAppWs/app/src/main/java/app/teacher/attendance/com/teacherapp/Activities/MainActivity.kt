package app.teacher.attendance.com.teacherapp.Activities

import android.app.Activity
import android.content.Intent
import android.graphics.Bitmap
import android.os.Build
import android.os.Bundle
import android.support.annotation.RequiresApi
import android.support.design.widget.NavigationView
import android.support.v7.app.ActionBarDrawerToggle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.View
import android.view.animation.AnimationUtils
import android.widget.ImageView
import android.widget.TextView
import app.student.attendance.com.teacherapp.Activities.ChangePasswordActivity
import app.student.attendance.com.teacherapp.Activities.ProfileActivity
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.Adapter.DashboardAdapter
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AppPreferences
import app.teacher.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.teacher.attendance.com.teacherapp.Utility.commonMethods
import app.teacher.attendance.com.teacherapp.Utility.commonVariables
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.Response.Listener
import com.android.volley.toolbox.ImageRequest
import com.android.volley.toolbox.StringRequest
import de.hdodenhof.circleimageview.CircleImageView
import kotlinx.android.synthetic.main.activity_main.*
import org.json.JSONObject


class MainActivity : AppCompatActivity() {
    var tv_school_name: TextView? = null
    var tv_student_name: TextView? = null
    var profile_image2: CircleImageView? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_main)
            setupActionBar()
            dashboardAPICall()
            val navigationView = findViewById<View>(R.id.nav_view) as NavigationView
            var headerview = navigationView.getHeaderView(0)
            tv_school_name = headerview!!.findViewById(R.id.tv_school_name) as TextView
            tv_student_name = headerview!!.findViewById(R.id.tv_student_name) as TextView
            profile_image2 = headerview!!.findViewById(R.id.profile_image2) as CircleImageView
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

        } catch (e: Exception) {
        }
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
                Listener<Bitmap> { response ->
                    try {
                        profile_image2!!.setImageBitmap(response);
                    } catch (e: Exception) {
                    }
                },
                0,
                0,
                ImageView.ScaleType.CENTER_CROP, // Image scale type
                Bitmap.Config.RGB_565, //Image decode configuration
                Response.ErrorListener { error ->
//                    Toast.makeText(this@MainActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }
        );

        App.getInstance().addToRequestQueue(imageRequest)

    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    public override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (resultCode == Activity.RESULT_OK && data != null) {
            if (data.getBooleanExtra(commonVariables.KEY_CHANGED, false)) {
                dashboardAPICall()
            } else if (data.getBooleanExtra(commonVariables.KEY_PROF_CHANGED, false)) {
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

    private fun setupActionBar() {
        try {
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
            nav_view.setNavigationItemSelectedListener(NavigationView.OnNavigationItemSelectedListener { item ->
                when (item.itemId) {
                    R.id.action_dashboard -> {
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }
                    R.id.action_timeTable -> {
                        startActivity(Intent(this@MainActivity, TimeTableActivity::class.java))
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }
                    R.id.action_noticeBoard -> {
                        startActivity(Intent(this@MainActivity, NoticeBoardActivity::class.java))
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }
//                    R.id.action_proxy -> {
//                        startActivity(Intent(this@MainActivity, ProxyActivity::class.java))
//                        drawer_layout.closeDrawers()
//                        return@OnNavigationItemSelectedListener true
//                    }
                    R.id.action_report -> {
                        startActivity(Intent(this@MainActivity, ReportActivity::class.java))
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }
                //                R.id.action_rep_datewise -> {
                //                    drawer_layout.closeDrawers()
                //                    return@OnNavigationItemSelectedListener true
                //                }
                //                R.id.action_rep_monthwise -> {
                //                    drawer_layout.closeDrawers()
                //                    return@OnNavigationItemSelectedListener true
                //                }
                    R.id.action_change_pass -> {
                        startActivity(Intent(this@MainActivity, ChangePasswordActivity::class.java))
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }
                    R.id.action_logout -> {
                        commonMethods.logout(this);
                        drawer_layout.closeDrawers()
                        return@OnNavigationItemSelectedListener true
                    }


                }
                false
            })
        } catch (e: Exception) {
        }

    }


    //    var response1 = ""
    private fun dashboardAPICall() {
        try {
            ProgressDialogUtil.showDialog(this@MainActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.DASHBOARD,
                    Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
//                            if (response1.isEmpty()  || !checkSame(response1, response)) {
//                                response1 = response
                            Log.e("loginRes=>", response)

                            //                    val JNObject = JSONObject("{\"Success\":1,\"Total_Recrod\":3,\"Today_Schedule\":[{\"Class_ID\":\"2\",\"Class_Name\":\"Std 10th A\",\"Subject_ID\":\"7\",\"Subject_Name\":\"English\",\"Batch_Name\":\"No\",\"Timing\":\"08:00 am To 09:00 am\",\"Day\":\"Wednesday\",\"No_Of_Student\":10},{\"Class_ID\":\"3\",\"Class_Name\":\"Std 10th B\",\"Subject_ID\":\"7\",\"Subject_Name\":\"English\",\"Batch_Name\":\"No\",\"Timing\":\"09:00 am To 10:00 am\",\"Day\":\"Wednesday\",\"No_Of_Student\":10},{\"Class_ID\":\"1\",\"Class_Name\":\"Std 9th A\",\"Subject_ID\":\"3\",\"Subject_Name\":\"English\",\"Batch_Name\":\"No\",\"Timing\":\"12:00 am To 01:00 pm\",\"Day\":\"Wednesday\",\"No_Of_Student\":9}]}")
                            val JNObject = JSONObject(response)
                            val resId = R.anim.layout_animation_fall_down
                            val animation = AnimationUtils.loadLayoutAnimation(this@MainActivity, resId)
                            lectureList.setLayoutAnimation(animation)
                            lectureList.layoutManager = LinearLayoutManager(this@MainActivity, LinearLayoutManager.VERTICAL, false);
                            lectureList.adapter = DashboardAdapter(JNObject.optJSONArray("Today_Schedule"), this@MainActivity)
//                            }
                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            //Toast.makeText(this@MainActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@MainActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Staff_ID", userDetail.optString("Staff_ID"))
                    } catch (e: Exception) {
                    }
                    return params
                }

            }
            App.getInstance().addToRequestQueue(stringRequest)
        } catch (e: Exception) {
        }
    }

//    private fun checkSame(response1: String, response: String?): Boolean {
//        val JNObject = JSONObject(response)
//        val JNObject1 = JSONObject(response1)
////        if (JNObject.optString())
//        return true
//    }

}

