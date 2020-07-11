package app.student.attendance.com.teacherapp.Adapter

import android.support.v7.widget.AppCompatButton
import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import app.student.attendance.com.teacherapp.R
import org.json.JSONArray

/**
 * adapter class for holding transfer items
 */
class DashboardAdapter(private var dataList: JSONArray)
    : RecyclerView.Adapter<DashboardAdapter.LectureViewHolder>() {

    public var hideAttendance: Boolean = false

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_dashboard, parent, false)
        return LectureViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        val jsonObject = dataList.optJSONObject(position)
        holder.class_name.text =jsonObject.optString("Class_Name")
        holder.subject.text =jsonObject.optString("Subject_Name")
        holder.time.text =jsonObject.optString("Timing")
        holder.student_count.text =jsonObject.optString("No_Of_Student")
        if (hideAttendance) {
            holder.attendance.visibility = View.GONE
        }
        if (jsonObject.optString("Attendance_Taken").equals("Yes")) {
            holder.student_count.text =jsonObject.optString("Present")+"/"+jsonObject.optString("No_Of_Student")+" Present"
            holder.attendance.text ="View Attendance"
        } else
            holder.attendance.text ="Attendance"
        holder.attendance.setOnClickListener(View.OnClickListener {

        })
    }

    override fun getItemCount(): Int {
        return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val class_name = itemView.findViewById<TextView>(R.id.class_name)
        val time = itemView.findViewById<TextView>(R.id.time)
        val subject = itemView.findViewById<TextView>(R.id.subject)
        val student_count = itemView.findViewById<TextView>(R.id.studentCount)
        val attendance = itemView.findViewById<AppCompatButton>(R.id.submitBtn)
    }


    override fun getItemViewType(position: Int): Int {
        return position
    }
}