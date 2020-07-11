package app.teacher.attendance.com.teacherapp.Utility;

import android.app.Dialog;
import android.content.Context;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import app.teacher.attendance.com.teacherapp.R;

public class AlertDialogManager {

    public static void showDialog(AppCompatActivity activity, String message, String btnPos, String btnNeg, final Runnable block1) {
        final Dialog dialog = new Dialog(activity);
        LayoutInflater inflater = (LayoutInflater) activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = inflater.inflate(R.layout.dialog_custom_alert_dialog, null);

        dialog.setContentView(view);
        dialog.getWindow().setLayout(LinearLayout.LayoutParams.WRAP_CONTENT, LinearLayout.LayoutParams.WRAP_CONTENT);
        dialog.getWindow().getAttributes().windowAnimations = R.style.DialogAnimationFade;
        dialog.show();
        Button mBtn_Done = view.findViewById(R.id.btn_done);
        mBtn_Done.setText(btnPos);
        TextView mTv_message = (TextView) view.findViewById(R.id.tv_message);
        mTv_message.setText(message);
        Button mBtn_no = view.findViewById(R.id.btn_no);
        if (btnNeg == null)
            mBtn_no.setVisibility(View.GONE);
        else
            mBtn_no.setText(btnNeg);
        mBtn_no.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
                view.startAnimation(buttonClick);
                dialog.dismiss();
            }
        });

        mBtn_Done.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
                view.startAnimation(buttonClick);

                if (block1 != null) {
                    block1.run();
                }
                dialog.dismiss();
            }
        });
    }
}
