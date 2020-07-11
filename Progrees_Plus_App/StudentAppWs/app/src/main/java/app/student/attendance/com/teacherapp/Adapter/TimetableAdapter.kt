package app.student.attendance.com.teacherapp.Adapter

import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import app.student.attendance.com.teacherapp.R
import org.json.JSONArray

/**
 * adapter class for holding transfer items
 */
class TimetableAdapter(private var dataList: JSONArray)
    : RecyclerView.Adapter<TimetableAdapter.LectureViewHolder>() {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_time_table, parent, false)
        return LectureViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        if (position == 0) {
            holder.iv_time.visibility = View.INVISIBLE
            holder.subject.visibility = View.GONE
        } else {
            holder.iv_time.visibility = View.VISIBLE
            holder.subject.visibility = View.VISIBLE
            val jsonObject = dataList.optJSONObject(position)
            holder.class_name.text =jsonObject.optString("Subject_Name")
            holder.subject.text ="(" + jsonObject.optString("Staff_Name") + ")"
            holder.time.text =jsonObject.optString("Timing")
        }
    }

    override fun getItemCount(): Int {
        return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val class_name = itemView.findViewById<TextView>(R.id.class_name)
        val time = itemView.findViewById<TextView>(R.id.time)
        val subject = itemView.findViewById<TextView>(R.id.subject)
        var iv_time = itemView.findViewById<ImageView>(R.id.iv_time)
    }


    override fun getItemViewType(position: Int): Int {
        return position
    }
}