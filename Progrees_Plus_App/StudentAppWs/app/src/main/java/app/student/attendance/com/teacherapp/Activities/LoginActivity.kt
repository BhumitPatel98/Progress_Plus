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
import kotlinx.android.synthetic.main.activity_login.*
import org.json.JSONObject

class LoginActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        submitBtn.setOnClickListener(View.OnClickListener {
            loginAPICall()
        })

        if (AppPreferences(this@LoginActivity).retrieveUser() != null) {
            startActivity(Intent(this@LoginActivity, MainActivity::class.java))
            onBackPressed()
        }
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }

    private fun validateFields(): Boolean {
        if (mobile.text.toString().trim().isEmpty()) {
            mobile.error = getString(R.string.pls_enter_mobile_no)
            return false

        }
        if (password.text.toString().trim().isEmpty()) {
            password.error = getString(R.string.pls_enter_password)
            return false
        }
        return true
    }


    private fun loginAPICall() {

        if (validateFields()) {

            ProgressDialogUtil.showDialog(this@LoginActivity);
            val stringRequest = object : StringRequest(Request.Method.POST, ApiSettings.LOGIN_URL,
                    Response.Listener<String> { response ->
                        try {
                            ProgressDialogUtil.hideDialog()
                            Log.e("loginRes=>", response)
                            val responseObject = JSONObject(response)
                            Toast.makeText(applicationContext, responseObject.getString("Message"),
                                    Toast.LENGTH_SHORT).show()
                            if (responseObject.getInt("Success") != 0) {
                                AppPreferences(this@LoginActivity).storeUser(response)
                                startActivity(Intent(this@LoginActivity, MainActivity::class.java))
                            }
                        } catch (e: Exception) {
                            e.printStackTrace()
                        }
                    },
                    Response.ErrorListener { error ->
                        Toast.makeText(this@LoginActivity, error.toString(), Toast.LENGTH_LONG).show()
                        ProgressDialogUtil.hideDialog();
                    }) {
                override fun getParams(): Map<String, String> {
                    val params = HashMap<String, String>()
                    params.put("Email", mobile.text.toString())
                    params.put("Password", password.text.toString())
                    return params
                }

            }

            App.getInstance().addToRequestQueue(stringRequest)
        }

    }
}
