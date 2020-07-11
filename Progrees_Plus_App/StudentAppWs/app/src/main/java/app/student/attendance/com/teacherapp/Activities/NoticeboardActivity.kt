package app.student.attendance.com.teacherapp.Activities

import android.app.Activity
import android.content.Intent
import android.os.Build
import android.os.Bundle
import android.support.annotation.RequiresApi
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.LinearLayoutManager
import android.util.Log
import android.view.MenuItem
import android.view.View
import android.widget.Toast
import app.student.attendance.com.teacherapp.API.ApiSettings
import app.student.attendance.com.teacherapp.Adapter.NoticeBoardAdapter
import app.student.attendance.com.teacherapp.App
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.AppPreferences
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.student.attendance.com.teacherapp.Utility.commonVariables
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_noticeboard_list.*
import org.json.JSONArray
import org.json.JSONObject


class NoticeboardActivity : AppCompatActivity() {
    var studList: JSONArray? = null
    override fun onCreate(savedInstanceState: Bundle?) {
        try {
            super.onCreate(savedInstanceState)
            setContentView(R.layout.activity_noticeboard_list)
            setActionBar()
            noticeBoardListAPICall()

            expanded_image.setOnClickListener(View.OnClickListener {
                ll_whole.visibility = View.VISIBLE
                expanded_image.visibility = View.GONE
                iv_close.visibility = View.GONE
            })

        } catch (e: Exception) {
        }
    }


    private fun setActionBar() {
        setSupportActionBar(toolbar)
        toolbar.setTitle("Notice Board")
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        toolbar.setNavigationOnClickListener(View.OnClickListener {
            onBackPressed()
        })
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

    override fun onOptionsItemSelected(item: MenuItem?): Boolean {
        val b = super.onOptionsItemSelected(item)
        if (item!!.itemId == R.id.action_timeTable)
            startActivity(Intent(this@NoticeboardActivity, TimeTableActivity::class.java))
        return b
    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    public override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (resultCode == Activity.RESULT_OK && data != null) {
            if (data.getBooleanExtra(commonVariables.KEY_CHANGED, false)) {
                noticeBoardListAPICall()
            }
        }
    }
    private fun noticeBoardListAPICall() {
        try {
            ProgressDialogUtil.showDialog(this@NoticeboardActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.STUDENT_NOTICELIST,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            progressBar.visibility = View.GONE
                            Log.e("loginRes=>", response)
                            studList = JSONObject(response).getJSONArray("Notice_List")
                            lectureList.layoutManager = LinearLayoutManager(this@NoticeboardActivity, LinearLayoutManager.VERTICAL, false);
                            lectureList.adapter = NoticeBoardAdapter(studList!!, this@NoticeboardActivity)

                        } catch (e: Exception) {
                        }
                    },
                    Response.ErrorListener { error ->
                        try {
                            Toast.makeText(this@NoticeboardActivity, error.toString(), Toast.LENGTH_LONG).show()
                            ProgressDialogUtil.hideDialog();
                        } catch (e: Exception) {
                        }
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    try {
                        val userDetail = JSONObject(AppPreferences(this@NoticeboardActivity).retrieveUser())
                        params.put("Institute_ID", userDetail.optString("Institute_ID"))
                        params.put("Class_ID", userDetail.optString("Class_ID"))
                    } catch (e: Exception) {
                    }
                    return params
                }

            }
            App.getInstance().addToRequestQueue(stringRequest)
        } catch (e: Exception) {
        }
    }

    fun showImage(url1: String?) {
        expanded_image.setImageUrl(url1, App.getInstance().getImageLoader());
        ll_whole.visibility = View.GONE
        iv_close.visibility = View.VISIBLE
        expanded_image.visibility = View.VISIBLE
    }

}
