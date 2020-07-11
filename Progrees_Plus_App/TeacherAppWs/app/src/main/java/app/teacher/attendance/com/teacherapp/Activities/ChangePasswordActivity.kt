package app.student.attendance.com.teacherapp.Activities

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.Toolbar
import android.text.TextUtils
import android.util.Log
import android.view.MenuItem
import android.view.View
import app.teacher.attendance.com.teacherapp.API.ApiSettings
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AlertDialogManager
import app.teacher.attendance.com.teacherapp.Utility.AppPreferences
import app.teacher.attendance.com.teacherapp.Utility.ProgressDialogUtil
import app.teacher.attendance.com.teacherapp.Utility.commonMethods
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import kotlinx.android.synthetic.main.activity_changepassword.*
import org.json.JSONObject

class ChangePasswordActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        try {
            setContentView(R.layout.activity_changepassword)

            val toolbar = findViewById(R.id.toolbar) as Toolbar
            setSupportActionBar(toolbar)

            supportActionBar!!.setDisplayShowHomeEnabled(true)
            supportActionBar!!.setDisplayHomeAsUpEnabled(true)
            supportActionBar!!.setDisplayShowTitleEnabled(false)
            btn_cancel.setOnClickListener(View.OnClickListener { onBackPressed() })
            btn_submit.setOnClickListener(View.OnClickListener {
                if (validate()) {
                    callChangePasswordMethod()
                }
            })
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }

    override fun onResume() {
        super.onResume()
        commonMethods.hasActiveInternetConnection(this)
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        when (item.itemId) {
            android.R.id.home -> {
                onBackPressed()
                return true
            }
            else -> return super.onOptionsItemSelected(item)
        }
    }

    private fun callChangePasswordMethod() {
        ProgressDialogUtil.showDialog(this@ChangePasswordActivity);
        val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.CHANGE_PASS,
                Response.Listener<String> { response ->
                    try {
                        ProgressDialogUtil.hideDialog()
                        Log.e("loginRes=>", response)
                        var jsonObject = JSONObject(response)

                        if (jsonObject.getInt("Success") != 0) {
                            var runner = Runnable { onBackPressed() }
                            AlertDialogManager.showDialog(this@ChangePasswordActivity, "Password changed successfully", "Ok", null, runner)
                        } else {
                            AlertDialogManager.showDialog(this@ChangePasswordActivity, jsonObject.optString("Message"), "Ok", null, null)
                        }

                    } catch (e: Exception) {
                    }
                },
                Response.ErrorListener { error ->
                    //Toast.makeText(this@ChangePasswordActivity, error.toString(), Toast.LENGTH_LONG).show()
                    ProgressDialogUtil.hideDialog();
                }) {
            override fun getParams(): Map<String, String> {
                val params = java.util.HashMap<String, String>()
                try {
                    val usersDetail = JSONObject(AppPreferences(this@ChangePasswordActivity).retrieveUser())
                    params.put("Staff_ID", usersDetail.optString("Staff_ID"))
                    params.put("Old_Password", edt_currentpsd.text.toString())
                    params.put("New_Password", edt_newpsd.text.toString())
                } catch (e: Exception) {
                    e.printStackTrace()
                }
                return params
            }
        }
        App.getInstance().addToRequestQueue(stringRequest)
    }

    private fun validate(): Boolean {
        if (TextUtils.isEmpty(edt_currentpsd.text)) {
            edt_currentpsd.error = "Current Password is required"
            return false
        }
        if (TextUtils.isEmpty(edt_newpsd.text)) {

            edt_newpsd.error = "New Password is required"
            return false
        }
        if (TextUtils.isEmpty(edt_confirmpsd.text)) {

            edt_confirmpsd.error = "Confirm Password is required"
            return false
        }
        if (edt_newpsd.text.toString() != edt_confirmpsd.text.toString()) {

            edt_confirmpsd.error = "Passwords do not match"
            return false
        } else
            return true
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

}
