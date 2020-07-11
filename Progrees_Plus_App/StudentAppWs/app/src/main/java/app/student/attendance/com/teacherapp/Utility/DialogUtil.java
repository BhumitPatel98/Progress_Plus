package app.student.attendance.com.teacherapp.Utility;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;

import app.student.attendance.com.teacherapp.R;

/**
 * Utility class to create and manage a generic dialog which will be used to show information through out the application
 */
public class DialogUtil {

    private AlertDialog dialog;
    private Activity activity;

    public DialogUtil(Activity activity) {
        this.activity = activity;
    }

    /**
     * Method to show dialog
     *
     * @param message Dialog message
     */
    public void showDialog(String message, Context context) {
        dialog = new AlertDialog.Builder(activity).create();
        dialog.setTitle(context.getResources().getString(R.string.app_name));
        dialog.setMessage(message);
        dialog.setButton(DialogInterface.BUTTON_POSITIVE, context.getResources().getString(R.string.ok), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dismissDialog();
            }
        });
        if (!dialog.isShowing())
            dialog.show();
    }

    /**
     * Method to dismiss dialog
     */
    public void dismissDialog() {
        if (dialog != null && dialog.isShowing()) {
            dialog.dismiss();
        }
    }
}
