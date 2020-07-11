package app.teacher.attendance.com.teacherapp.Adapter

import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.CheckBox
import android.widget.TextView
import app.teacher.attendance.com.teacherapp.R
import org.json.JSONArray

/**
 * adapter class for holding transfer items
 */
class AttendenceAdapter(var dataList: JSONArray)
    : RecyclerView.Adapter<AttendenceAdapter.LectureViewHolder>() {

    public var hideAttendance: Boolean = false

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_attendence, parent, false)
        return LectureViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        val jsonObject = dataList.optJSONObject(position)
        holder.stud_id.text = jsonObject.optString("Student_ID")
        holder.stud_name.text = jsonObject.optString("Student_Name")
        holder.isAttend.isChecked = !jsonObject.optString("Attendance").equals("Absent", false)
        holder.isAttend.setOnCheckedChangeListener { buttonView, isChecked ->
            if (isChecked) {
                dataList.optJSONObject(position).put("Attendance", "Present")
            } else
                dataList.optJSONObject(position).put("Attendance", "Absent")
        }
        holder.stud_name.setOnClickListener(View.OnClickListener { holder.isAttend.setChecked(!holder.isAttend.isChecked()); })
        holder.stud_id.setOnClickListener(View.OnClickListener { holder.isAttend.setChecked(!holder.isAttend.isChecked()); })
    }

    override fun getItemCount(): Int {
        return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val stud_id = itemView.findViewById<TextView>(R.id.title)
        val stud_name = itemView.findViewById<TextView>(R.id.tv_message)
        val isAttend = itemView.findViewById<CheckBox>(R.id.isAttend)

    }


    override fun getItemViewType(position: Int): Int {
        return position
    }
}