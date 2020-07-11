package app.teacher.attendance.com.teacherapp.Activities

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
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.Adapter.NoticeBoardAdapter
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AppPreferences
import app.teacher.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.teacher.attendance.com.teacherapp.Utility.commonVariables
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_noticeboard_list.*
import org.json.JSONArray
import org.json.JSONObject

class NoticeBoardActivity : AppCompatActivity() {
    var studList: JSONArray? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_noticeboard_list)
        setActionBar()
        noticeBoardListAPICall()
        fb_add.setOnClickListener(View.OnClickListener {
            intent = Intent(this@NoticeBoardActivity, NoticeAddActivity::class.java)
            startActivityForResult(intent, commonVariables.REQUEST_CHANGE)
            overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
        })
        expanded_image.setOnClickListener(View.OnClickListener {
            ll_whole.visibility = View.VISIBLE
            expanded_image.visibility = View.GONE
            iv_close.visibility = View.GONE
        })
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
            startActivity(Intent(this@NoticeBoardActivity, TimeTableActivity::class.java))
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
        ProgressDialogUtil.showDialog(this@NoticeBoardActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.STAFF_NOTICELIST,
                Response.Listener<String> { response ->
                    try {
                        ProgressDialogUtil.hideDialog()
                        progressBar.visibility = View.GONE
                        Log.e("loginRes=>", response)
                        studList = JSONObject(response).getJSONArray("Notice_List")
                        lectureList.layoutManager = LinearLayoutManager(this@NoticeBoardActivity, LinearLayoutManager.VERTICAL, false);
                        lectureList.adapter = NoticeBoardAdapter(studList!!, this@NoticeBoardActivity)
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@NoticeBoardActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val usersDetail = JSONObject(AppPreferences(this@NoticeBoardActivity).retrieveUser())
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


    fun deleteItem(noticeId: Int) {
        ProgressDialogUtil.showDialog(this@NoticeBoardActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.NOTICELIST_DELETE,
                Response.Listener<String> { response ->
                    try {
                        ProgressDialogUtil.hideDialog()
                        progressBar.visibility = View.GONE
                        noticeBoardListAPICall()
                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@NoticeBoardActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                try {
                    val usersDetail = JSONObject(AppPreferences(this@NoticeBoardActivity).retrieveUser())
                    params.put("Institute_ID", usersDetail.optString("Institute_ID"))
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    params.put("Notice_ID", noticeId.toString())
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }

        }
        App.getInstance().addToRequestQueue(stringRequest)

    }

    fun showImage(url1: String?) {
        expanded_image.setImageUrl(url1, App.getInstance().getImageLoader());
        ll_whole.visibility = View.GONE
        iv_close.visibility = View.VISIBLE
        expanded_image.visibility = View.VISIBLE
    }


}
