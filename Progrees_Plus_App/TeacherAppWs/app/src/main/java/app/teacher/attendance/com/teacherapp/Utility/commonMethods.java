package app.teacher.attendance.com.teacherapp.Utility;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.support.design.widget.Snackbar;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

import app.teacher.attendance.com.teacherapp.Activities.SplashActivity;
import app.teacher.attendance.com.teacherapp.R;


@SuppressLint("SimpleDateFormat")
public class commonMethods {

    public static boolean hasActiveInternetConnection(Activity activity) {
        try {
            if (isInternet(activity.getApplicationContext())) {
                new CheckInternet(activity).execute();
            } else {
                showSnakebar(activity);
                Log.d("TAG", "No network available!");
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return false;
    }

    public static class CheckInternet extends AsyncTask<Object, Object, Boolean> {
        Activity activity;

        public CheckInternet(Activity act) {
            activity = act;
        }

        @Override
        protected Boolean doInBackground(Object... strings) {
            try {
                HttpURLConnection urlc = (HttpURLConnection) (new URL("http://www.google.com").openConnection());
                urlc.setRequestProperty("User-Agent", "Test");
                urlc.setRequestProperty("Connection", "close");
                urlc.setConnectTimeout(1500);
                urlc.connect();
                return (urlc.getResponseCode() == 200);
            } catch (IOException e) {
                showSnakebar(activity);
                Log.e("TAG", "Error checking internet connection", e);
            }
            return null;
        }

    }

    public static void copyStream(InputStream input, OutputStream output) throws IOException {
        try {
            byte[] buffer = new byte[1024];
            int bytesRead;
            while ((bytesRead = input.read(buffer)) != -1) {
                output.write(buffer, 0, bytesRead);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

    public static void showSnakebar(Activity activity) {
        if (activity != null) {
            final ViewGroup viewGroup = (ViewGroup) ((ViewGroup) activity
                    .findViewById(android.R.id.content)).getChildAt(0);
            Snackbar snack = Snackbar.make(viewGroup, R.string.no_internet, Snackbar.LENGTH_LONG);
            View view = snack.getView();
            TextView tv = (TextView) view.findViewById(android.support.design.R.id.snackbar_text);
            tv.setTextColor(Color.WHITE);
            snack.show();
        }
    }

    public static Uri getUriFromFile(File file, Context applicationContext) {
        Uri tempFileUri = null;
        try {
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                tempFileUri = FileProvider.getUriForFile(applicationContext,
                        "app.teacher.attendance.com.teacherapp.com.scanlibrary.provider", // As defined in Manifest
                        file);
            } else {
                tempFileUri = Uri.fromFile(file);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return tempFileUri;
    }

    public static boolean isInternet(Context activity) {
        if (activity != null && (isConnectedWifi(activity) || isConnectedMobile(activity))) {
            return true;
        }
        return false;
    }

    public static boolean isConnectedWifi(Context context) {
        NetworkInfo info = getNetworkInfo(context);
        return (info != null && info.isConnected() && info.getType() == ConnectivityManager.TYPE_WIFI);
    }

    public static boolean isConnectedMobile(Context context) {
        NetworkInfo info = getNetworkInfo(context);
        return (info != null && info.isConnected() && info.getType() == ConnectivityManager.TYPE_MOBILE);
    }

    public static NetworkInfo getNetworkInfo(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        return cm.getActiveNetworkInfo();
    }

    public static void logout(final AppCompatActivity activity) {
        Runnable listener = new Runnable() {
            @Override
            public void run() {
                logoutFromApp(activity);
            }
        };
        AlertDialogManager.showDialog(activity, "Do you want to sign out?", "Yes", "Cancel", listener);
    }

    public static void logoutFromApp(AppCompatActivity activity) {
        try {
            AppPreferences.clearPref();

            clearCacheData(activity);
            Intent intent = new Intent(activity, SplashActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            activity.startActivity(intent);
            activity.finish();
            activity.overridePendingTransition(0, 0);

        } catch (Exception e) {
            e.printStackTrace();
            Log.e(commonVariables.TAG, "Exception: " + e.getMessage());
        }
    }

    private static void clearCacheData(AppCompatActivity activity) {
        try {
            File cacheDirectory = activity.getCacheDir();
            File applicationDirectory = new File(cacheDirectory.getParent());
            if (applicationDirectory.exists()) {
                String[] fileNames = applicationDirectory.list();
                for (String fileName : fileNames) {
                    if (!fileName.equals("lib")) {
                        deleteFile(new File(applicationDirectory, fileName));
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static boolean deleteFile(File file) {
        boolean deletedAll = true;
        try {
            if (file != null) {
                if (file.isDirectory()) {
                    String[] children = file.list();
                    for (int i = 0; i < children.length; i++) {
                        deletedAll = deleteFile(new File(file, children[i])) && deletedAll;
                    }
                } else {
                    deletedAll = file.delete();
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return deletedAll;
    }
}
