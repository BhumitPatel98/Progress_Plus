package app.teacher.attendance.com.teacherapp.Adapter

import android.content.Intent
import android.net.Uri
import android.support.v7.widget.RecyclerView
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import app.teacher.attendance.com.teacherapp.Activities.NoticeBoardActivity
import app.teacher.attendance.com.teacherapp.App
import app.teacher.attendance.com.teacherapp.R
import app.teacher.attendance.com.teacherapp.Utility.AlertDialogManager
import com.android.volley.toolbox.NetworkImageView
import de.hdodenhof.circleimageview.CircleImageView
import org.json.JSONArray

/**
 * adapter class for holding transfer items
 */
class NoticeBoardAdapter(private var dataList: JSONArray, private var activity: NoticeBoardActivity)
    : RecyclerView.Adapter<NoticeBoardAdapter.LectureViewHolder>() {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): LectureViewHolder {
        val itemView = LayoutInflater.from(parent.context)
                .inflate(R.layout.adapter_row_noticeboard, parent, false)
        return LectureViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: LectureViewHolder, position: Int) {
        try {
            val jsonObject = dataList.optJSONObject(position)
            holder.mTitle.text = jsonObject.optString("Title")
            holder.mMessage.text = jsonObject.optString("Message")
            holder.mDate.text = jsonObject.optString("From_date") + " to " + jsonObject.optString("To_date")
            holder.mFor_class.text = "For " + jsonObject.optString("Class_List_Name").replace(";", ", ")
            holder.mIv_delete.setOnClickListener(View.OnClickListener {
                val listener = Runnable { activity.deleteItem(jsonObject.optInt("Notice_ID")) }
                AlertDialogManager.showDialog(activity, "Do you want to delete this notice?", "Yes", "Cancel", listener)

            })
            var url1 = jsonObject.optString("Url_1")
            if (url1 != null && !url1.isEmpty()) {
                holder.mIv_url1.visibility = View.VISIBLE
                var a = url1.split(".")
                var ext = a[a.size - 1]
                if (ext.equals("png", false) || ext.equals("jpg", false) || ext.equals("jpeg", false)) {
                    holder.mIv_url1.setDefaultImageResId(R.drawable.logo_white); // image for loading...
                    holder.mIv_url1.setImageUrl(url1, App.getInstance().getImageLoader());
                    holder.mIv_url1.setOnClickListener(View.OnClickListener {
                        activity.showImage(url1)
                    })
                } else {
                    if (ext.equals("pdf", false)) {
                        holder.mIv_url1.setDefaultImageResId(R.drawable.ic_picture_as_pdf_black_24dp); // image for loading...
                    } else if (ext.equals("doc", false) || ext.equals("docx", false)) {
                        holder.mIv_url1.setDefaultImageResId(R.drawable.ic_doc); // image for loading...
                    }
                    holder.mIv_url1.setOnClickListener(View.OnClickListener {
                        try {
                            val browserIntent = Intent(Intent.ACTION_VIEW, Uri.parse(url1))
                            activity.startActivity(browserIntent)
                            activity.overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
                        } catch (e: Exception) {
                            e.printStackTrace()
                        }

                    })
                }
            } else
                holder.mIv_url1.visibility = View.GONE

            var url2 = jsonObject.optString("Url_2")
            if (url2 != null && !url2.isEmpty()) {
                holder.mIv_url2.visibility = View.VISIBLE
                var a = url2.split(".")
                var ext = a[a.size - 1]
                if (ext.equals("png", false) || ext.equals("jpg", false) || ext.equals("jpeg", false)) {
                    holder.mIv_url2.setDefaultImageResId(R.drawable.logo_white); // image for loading...
                    holder.mIv_url2.setImageUrl(url2, App.getInstance().getImageLoader());
                    holder.mIv_url2.setOnClickListener(View.OnClickListener {
                        activity.showImage(url2)
                    })
                } else {
                    if (ext.equals("pdf", false)) {
                        holder.mIv_url2.setDefaultImageResId(R.drawable.ic_picture_as_pdf_black_24dp);
                    } else if (ext.equals("doc", false) || ext.equals("docx", false)) {
                        holder.mIv_url2.setDefaultImageResId(R.drawable.ic_doc); // image for loading...
                    }
                    holder.mIv_url2.setOnClickListener(View.OnClickListener {
                        try {
                            val browserIntent = Intent(Intent.ACTION_VIEW, Uri.parse(url2))
                            activity.startActivity(browserIntent)
                            activity.overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
                        } catch (e: Exception) {
                            e.printStackTrace()
                        }

                    })
                }
            } else
                holder.mIv_url2.visibility = View.GONE

            var url3 = jsonObject.optString("Url_3")
            if (url3 != null && !url3.isEmpty()) {
                holder.mIv_url3.visibility = View.VISIBLE
                var a = url3.split(".")
                var ext = a[a.size - 1]
                if (ext.equals("png", false) || ext.equals("jpg", false) || ext.equals("jpeg", false)) {
                    holder.mIv_url3.setDefaultImageResId(R.drawable.logo_white); // image for loading...
                    holder.mIv_url3.setImageUrl(url3, App.getInstance().getImageLoader());
                    holder.mIv_url3.setOnClickListener(View.OnClickListener {
                        activity.showImage(url3)
                    })
                } else {
                    if (ext.equals("pdf", false)) {
                        holder.mIv_url3.setDefaultImageResId(R.drawable.ic_picture_as_pdf_black_24dp)
                    } else if (ext.equals("doc", false) || ext.equals("docx", false)) {
                        holder.mIv_url3.setDefaultImageResId(R.drawable.ic_doc)
                    }
                    holder.mIv_url3.setOnClickListener(View.OnClickListener {
                        try {
                            val browserIntent = Intent(Intent.ACTION_VIEW, Uri.parse(url3))
                            activity.startActivity(browserIntent)
                            activity.overridePendingTransition(R.anim.fade_in_fast, R.anim.fade_out_fast)
                        } catch (e: Exception) {
                            e.printStackTrace()
                        }

                    })
                }
            } else
                holder.mIv_url3.visibility = View.GONE


        } catch (e: Exception) {
        }
    }

    override fun getItemCount(): Int {
        if (dataList == null || dataList.length() == 0)
            return 10
        else
            return dataList.length()
    }


    class LectureViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var mProfile_image2 = itemView.findViewById<CircleImageView>(R.id.profile_image2);
        var mTitle = itemView.findViewById<TextView>(R.id.title);
        var mFor_class = itemView.findViewById<TextView>(R.id.for_class);
        var mMessage = itemView.findViewById<TextView>(R.id.tv_message);
        var mIv_url1 = itemView.findViewById<NetworkImageView>(R.id.iv_url1);
        var mIv_url2 = itemView.findViewById<NetworkImageView>(R.id.iv_url2);
        var mIv_url3 = itemView.findViewById<NetworkImageView>(R.id.iv_url3);
        var mIv_delete = itemView.findViewById<ImageView>(R.id.iv_delete);
        var mDate = itemView.findViewById<TextView>(R.id.date);
    }

    override fun getItemViewType(position: Int): Int {
        return position
    }
}