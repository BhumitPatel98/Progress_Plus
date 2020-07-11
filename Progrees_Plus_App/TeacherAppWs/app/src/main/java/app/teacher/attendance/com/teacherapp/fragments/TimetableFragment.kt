package app.teacher.attendance.com.teacherapp.fragments

import android.os.Bundle
import android.support.v4.app.Fragment
import android.support.v7.widget.LinearLayoutManager
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import app.teacher.attendance.com.teacherapp.Adapter.TimetableAdapter
import app.teacher.attendance.com.teacherapp.R
import kotlinx.android.synthetic.main.timetable_list.view.*
import org.json.JSONArray
import org.json.JSONObject

class TimetableFragment : Fragment() {

    var timeTableValues = JSONArray()
    var mainView: View? = null

    companion object {
        var timetableFragment: TimetableFragment? = null
        public fun getInstance(timeTableValues: JSONArray): TimetableFragment {
            timetableFragment = TimetableFragment()
            if (timeTableValues.length() != 0) {
                var ja = JSONArray()
                var jo = JSONObject()
                ja.put(jo)
                for (i in 0..(timeTableValues.length() - 1)) {
                    val item = timeTableValues.getJSONObject(i)
                    ja.put(item)
                }
                timetableFragment!!.timeTableValues = ja;
            } else
                timetableFragment!!.timeTableValues = timeTableValues
            return timetableFragment as TimetableFragment
        }
    }

    override fun onCreateView(inflater: LayoutInflater, container: ViewGroup?, savedInstanceState: Bundle?): View? {
        super.onCreateView(inflater, container, savedInstanceState)
        mainView = inflater.inflate(R.layout.timetable_list, null, false)
        setAdapter()
        return mainView
    }


    private fun setAdapter() {
        mainView!!.progressBar.visibility = View.GONE
        mainView!!.lectureList.layoutManager = LinearLayoutManager(context, LinearLayoutManager.VERTICAL, false);
        val adapter = TimetableAdapter(timeTableValues)

        mainView!!.lectureList.adapter = adapter
        mainView!!.progressBar.visibility = View.GONE
        if (timeTableValues.length() == 0)
            mainView!!.noItemFound.visibility = View.VISIBLE
    }

}

