package app.teacher.attendance.com.teacherapp.Utility;

import android.app.Activity;
import android.app.ProgressDialog;

/**
 * Created by satyam on 7/14/2017.
 * util class for progress dialog
 */

public class ProgressDialogUtil {
    private static ProgressDialog Pdialog;

    public static void showDialog(Activity activity) {
        Pdialog = new ProgressDialog(activity);
        Pdialog.setIndeterminate(true);
        Pdialog.setMessage("Please wait...");
        Pdialog.setCancelable(false);
        Pdialog.show();
    }

    public static void hideDialog() {
        if (Pdialog != null && Pdialog.isShowing())
            Pdialog.dismiss();
    }
}
