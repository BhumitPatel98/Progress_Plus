package app.teacher.attendance.com.teacherapp.Activities

import android.content.Intent
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.view.animation.AnimationUtils
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AppPreferences

class SplashActivity : AppCompatActivity() {
    var isTimerOut = false;
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_splash)

        val animation = AnimationUtils.loadAnimation(applicationContext, R.anim.fade_in_slow)
        val bottomUp = AnimationUtils.loadAnimation(this,
                R.anim.bottom_up)
//        bottomUp.setAnimationListener(object : Animation.AnimationListener {
//            override fun onAnimationStart(animation: Animation) {
//            }
//
//            override fun onAnimationEnd(animation: Animation) {
//                isTimerOut = true
//                launchHomeScreen()
//            }
//
//            override fun onAnimationRepeat(animation: Animation) {
//
//            }
//        })
//        ll_logo.startAnimation(bottomUp)


//        ll_logo.setVisibility(View.VISIBLE)
//        animation.setAnimationListener(object : Animation.AnimationListener {
//            override fun onAnimationStart(animation: Animation?) {
//
//            }
//
//            override fun onAnimationRepeat(animation: Animation?) {
//
//            }
//
//            override fun onAnimationEnd(animation: Animation?) {
//                isTimerOut = true
//                launchHomeScreen()
//            }
//        })
//        tv_rights.startAnimation(animation)

        launchHomeScreen()
    }


    private fun launchHomeScreen() {
        try {
            if (AppPreferences(this@SplashActivity).retrieveUser() == null) {
                startActivity(Intent(this@SplashActivity, LoginActivity::class.java))
            } else {
                startActivity(Intent(this@SplashActivity, MainActivity::class.java))
            }
            finish()
            overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
        } catch (e: Exception) {
            e.printStackTrace()
        }

    }
}
