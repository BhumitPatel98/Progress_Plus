package app.student.attendance.com.teacherapp.Adapter

import android.content.Intent
import android.support.v7.widget.AppCompatButton
import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.LinearLayout
import android.widget.TextView
import app.student.attendance.com.teacherapp.Activities.ReportMonthActivity
import app.student.attendance.com.teacherapp.Activities.ReportMonthDetailActivity
import app.student.attendance.com.teacherapp.R
import app.student.attendance.com.teacherapp.Utility.commonVariables
import kotlinx.android.synthetic.main.activity_report_month.*
import org.json.JSONArray
import java.util.*

/**
 * adapter class for holding transfer items
 */
class ReportMonthAdapter(private var dataList: JSONArray, private var mainActivity: ReportMonthActivity)
    : RecyclerView.Adapter<ReportMonthAdapter.LectureViewHolder>() {
    lateinit var androidColors: IntArray

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_report_month, parent, false)
        androidColors = mainActivity.getResources().getIntArray(R.array.androidcolors)
        return LectureViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        val jsonObject = dataList.optJSONObject(position)
        holder.mSubject_name.text =jsonObject.optString("Subject_Name")
        holder.mTeacher_name.text ="(" + jsonObject.optString("Staff_Name") + ")"
//        holder.mType.text =jsonObject.optString("Type")
//        holder.mBatch_name.text =jsonObject.optString("Batch_Name")
        holder.mPercentange.text =jsonObject.optString("Percentange")
        holder.mStudentCount.text =jsonObject.optString("Total_Present") + "/" + jsonObject.optString("Total_Lecture") + " Present"
        holder.mSubmitBtn.setOnClickListener(View.OnClickListener {
            val intent = Intent(holder.mSubmitBtn.context, ReportMonthDetailActivity::class.java)
            intent.putExtra("REPORT_DETAIL", jsonObject.toString())
            intent.putExtra("MONTH",mainActivity.month.text.toString())
            intent.putExtra("YEAR", mainActivity.year.text.toString())
            mainActivity.startActivityForResult(intent, commonVariables.REQUEST_CHANGE)
            mainActivity.overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)

        })
        val randomAndroidColor = androidColors[Random().nextInt(androidColors.size)]
        holder.ll_colo.setBackgroundColor(randomAndroidColor)
    }

    override fun getItemCount(): Int {
        return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var mSubject_name = itemView.findViewById<TextView>(R.id.subject_name);
        var mTeacher_name = itemView.findViewById<TextView>(R.id.teacher_name);
//        var mType = itemView.findViewById<TextView>(R.id.type);
//        var mBatch_name = itemView.findViewById<TextView>(R.id.batch_name);
        var mStudentCount = itemView.findViewById<TextView>(R.id.studentCount);
        var mPercentange = itemView.findViewById<TextView>(R.id.percentange);
        var mSubmitBtn = itemView.findViewById<AppCompatButton>(R.id.submitBtn);
        var ll_colo = itemView.findViewById<LinearLayout>(R.id.ll_colo);

    }


    override fun getItemViewType(position: Int): Int {
        return position
    }
}