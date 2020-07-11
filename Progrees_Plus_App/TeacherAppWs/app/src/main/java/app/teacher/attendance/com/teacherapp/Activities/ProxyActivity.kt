package app.teacher.attendance.com.teacherapp.Activities

import android.app.DatePickerDialog
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.view.View
import app.teacher.attendance.com.teacherapp.R
import kotlinx.android.synthetic.main.activity_proxy.*
import java.util.*


class ProxyActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_proxy)
        setActionBar()

        date.setOnClickListener(View.OnClickListener {
            val calendar = Calendar.getInstance()
            val yy = calendar.get(Calendar.YEAR)
            val mm = calendar.get(Calendar.MONTH)
            val dd = calendar.get(Calendar.DAY_OF_MONTH)
            val datePicker = DatePickerDialog(this, DatePickerDialog.OnDateSetListener { view, year, monthOfYear, dayOfMonth ->
                val datest = (dayOfMonth.toString() + "/" + (monthOfYear + 1).toString()
                        + "/" + year.toString())

                date.text = datest
            }, yy, mm, dd)
            datePicker.getDatePicker().setMinDate(System.currentTimeMillis() - 1000);
            datePicker.show()
        })

    }


    private fun setActionBar() {
        //Set dashboard
        setSupportActionBar(toolbar)
        toolbar.setTitle("Create Notice")
        supportActionBar!!.setDisplayHomeAsUpEnabled(true)
        toolbar.setNavigationOnClickListener(View.OnClickListener {
            onBackPressed()
        })
    }

    override fun onBackPressed() {
        finish()
        overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
    }


}
