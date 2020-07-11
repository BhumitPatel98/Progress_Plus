package app.student.attendance.com.teacherapp.Adapter

import android.os.Build
import android.support.annotation.RequiresApi
import android.support.v4.content.ContextCompat
import android.support.v7.app.AppCompatActivity
import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import app.student.attendance.com.teacherapp.R
import org.json.JSONArray

/**
 * adapter class for holding transfer items
 */
class ReportDateDetailAdapter(private var dataList: JSONArray, private var mainActivity: AppCompatActivity)
    : RecyclerView.Adapter<ReportDateDetailAdapter.LectureViewHolder>() {
    var abs: Int = R.color.absent
    var pres: Int = R.color.present
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_report_month_detail, parent, false)
        try {
            abs = ContextCompat.getColor(mainActivity, R.color.absent)
            pres = ContextCompat.getColor(mainActivity, R.color.present)
        } catch (e: Exception) {
        }
        return LectureViewHolder(itemView)
    }

    @RequiresApi(Build.VERSION_CODES.M)
    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        try {
            val jsonObject = dataList.optJSONObject(position)
            holder.subject.visibility = View.GONE;
            holder.date.text = jsonObject.optString("Date")
            holder.stud_name.text = jsonObject.optString("Day")
            holder.isAttend.text = jsonObject.optString("Attendance")
            if (jsonObject.optString("Attendance").equals("Absent")) {
                holder.isAttend.text = "A"
                holder.isAttend.setBackgroundColor(abs)
            } else {
                holder.isAttend.text = "P"
                holder.isAttend.setBackgroundColor(pres)
            }
        } catch (e: Exception) {
            Toast.makeText(mainActivity, e.message, Toast.LENGTH_SHORT).show()
            e.printStackTrace();
        }
    }

    override fun getItemCount(): Int {
        return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var date = itemView.findViewById<TextView>(R.id.time);
        var stud_name = itemView.findViewById<TextView>(R.id.class_name);
        var subject = itemView.findViewById<TextView>(R.id.subject);
        var isAttend = itemView.findViewById<TextView>(R.id.isAttend);
    }


    override fun getItemViewType(position: Int): Int {
        return position
    }
}