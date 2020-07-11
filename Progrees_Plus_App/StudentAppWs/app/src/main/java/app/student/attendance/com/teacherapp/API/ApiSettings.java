package app.student.attendance.com.teacherapp.API;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.webkit.MimeTypeMap;
import android.widget.Toast;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import app.student.attendance.com.teacherapp.Utility.OnDataSendToActivity;
import app.student.attendance.com.teacherapp.Utility.ProgressDialogUtil;

/**
 * Created by jogendra on 3/11/2016.
 * Class To design URLs used for API calling
 */
public class ApiSettings {
    //LIVE Server URL
    private static String BASE_URL = "http://www.opustech.in/progress_api/"; // ip base url
    public static final String LOGIN_URL = BASE_URL + "student_login.php";
    public static final String TIMETABLE = BASE_URL + "Student_Timetable.php";
    public static final String STUDENT_NOTICELIST = BASE_URL + "Student_Noticeboard.php";
    public static final String STUDENT_GET_PROFILE = BASE_URL + "View_Student_Profile.php";
    public static final String STUDENT_EDIT_PROFILE = BASE_URL + "Student_Profile.php";
    public static final String PPIC_UPLOAD = BASE_URL + "Upload_Student_Pic.php";
    public static final String CHANGE_PASS = BASE_URL + "Student_Change_Password.php";
    public static final String REPORT_MONTHWISE = BASE_URL + "Student_Subject_Monthwise.php";
    public static final String REPORT_MONTHWISE_LIST = BASE_URL + "Student_Subject_List_Monthwise.php";
    public static final String REPORT_DATEWISE = BASE_URL + "Student_Subject_Datewise.php";
    public static final String REPORT_DATEWISE_LIST = BASE_URL + "Student_Subject_List_Datewise.php";
    public static final String REPORT_STUDENT_DETAIL_LIST = BASE_URL + "Student_Report_Datewise.php";
    public static final String REPORT_STUDENT_LIST = BASE_URL + "Student_Report.php";


    public static void UploadFile(AppCompatActivity activity, OnDataSendToActivity onresult, String action, String Institute_ID, String Staff_ID, File file) {
        try {
            new UploadFileBg(activity, onresult, action, Institute_ID, Staff_ID, file).execute();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    int serverResponseCode;

    public static class UploadFileBg extends AsyncTask<String, String, String> {
        AppCompatActivity activity;
        OnDataSendToActivity onresult;
        String responseString = null;
        File file;
        String Institute_ID, Staff_ID, action;

        public UploadFileBg(AppCompatActivity activity, OnDataSendToActivity onresult, String action, String Institute_ID, String Staff_ID, File file) {
            this.activity = activity;
            this.onresult = onresult;
            this.file = file;
            this.Institute_ID = Institute_ID;
            this.action = action;
            this.file = file;
            this.Staff_ID = Staff_ID;
        }


        @Override
        protected String doInBackground(String... strings) {
            return uploadFile(action, Institute_ID + "", Staff_ID, file);
            //setup params
//            Map<String, String> params = new HashMap<String, String>(2);
//            params.put("Institute_ID", Institute_ID);
//            params.put("Staff_ID", Staff_ID);
//
//            try {
//                return multipartRequest(ApiSettings.PPIC_UPLOAD, params, file);
//            } catch (Exception e) {
//                e.printStackTrace();
//                return "";
//            }
        }

        public String uploadFile(String action, String Institute_ID, String Student_ID, File sourceFile) {


            String fileName = sourceFile.getName();

            HttpURLConnection conn = null;
            DataOutputStream dos = null;
            String lineEnd = "\r\n";
            String twoHyphens = "--";
            String boundary = "*****";
            int bytesRead, bytesAvailable, bufferSize;
            byte[] buffer;
            int maxBufferSize = 1 * 1024 * 1024;
            String result = "";

            try {

                // open a URL connection to the Servlet
                FileInputStream fileInputStream = new FileInputStream(sourceFile);
                URL url = new URL(ApiSettings.PPIC_UPLOAD);

                // Open a HTTP  connection to  the URL
                conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true); // Allow Inputs
                conn.setDoOutput(true); // Allow Outputs
                conn.setUseCaches(false); // Don't use a Cached Copy
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Connection", "Keep-Alive");
                conn.setRequestProperty("ENCTYPE", "multipart/form-data");
                conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
                conn.setRequestProperty("uploaded_file", fileName);

                dos = new DataOutputStream(conn.getOutputStream());

                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=" + "Photo" + ";filename=\""
                        + fileName + "\"" + lineEnd);
                dos.writeBytes(lineEnd);
                bytesAvailable = fileInputStream.available();

                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                buffer = new byte[bufferSize];

                // read file and write it into form...
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                while (bytesRead > 0) {

                    dos.write(buffer, 0, bufferSize);
                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                }

                // send multipart form data necesssary after file data...
                dos.writeBytes(lineEnd);
                dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);


                StringBuffer sb = new StringBuffer();
                InputStream is = null;

                try {
                    is = new BufferedInputStream(conn.getInputStream());
                    BufferedReader br = new BufferedReader(new InputStreamReader(is));
                    String inputLine = "";
                    while ((inputLine = br.readLine()) != null) {
                        sb.append(inputLine);
                    }
                    result = sb.toString();
                } catch (Exception e) {
                    Log.i("TAG", "Error reading InputStream");
                    result = null;
                } finally {
                    if (is != null) {
                        try {
                            is.close();
                        } catch (IOException e) {
                            Log.i("TAG", "Error closing InputStream");
                        }
                    }
                }

                //close the streams //
                fileInputStream.close();
                dos.flush();
                dos.close();

            } catch (MalformedURLException ex) {
                ex.printStackTrace();

                activity.runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(activity, "MalformedURLException",
                                Toast.LENGTH_SHORT).show();
                    }
                });

                Log.e("Upload file to server", "error: " + ex.getMessage(), ex);
            } catch (Exception e) {
                e.printStackTrace();

                activity.runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(activity, "Got Exception : see logcat ",
                                Toast.LENGTH_SHORT).show();
                    }
                });
                Log.e("TAG", "Exception : "
                        + e.getMessage(), e);
            }
            return result + "";
        }

//        public String multipartRequest(String urlTo, Map<String, String> parmas, File file) throws Exception {
//            HttpURLConnection connection = null;
//            DataOutputStream outputStream = null;
//            InputStream inputStream = null;
//
//            String twoHyphens = "--";
//            String boundary = "*****" + Long.toString(System.currentTimeMillis()) + "*****";
//            String lineEnd = "\r\n";
//
//            String result = "";
//
//            int bytesRead, bytesAvailable, bufferSize;
//            byte[] buffer;
//            int maxBufferSize = 1 * 1024 * 1024;
//
////            String[] q = filepath.split("/");
////            int idx = q.length - 1;
//
//            try {
//                FileInputStream fileInputStream = new FileInputStream(file);
//
//                URL url = new URL(urlTo);
//                connection = (HttpURLConnection) url.openConnection();
//
//                connection.setDoInput(true);
//                connection.setDoOutput(true);
//                connection.setUseCaches(false);
//
//                connection.setRequestMethod("POST");
//                connection.setRequestProperty("Connection", "Keep-Alive");
//                connection.setRequestProperty("User-Agent", "Android Multipart HTTP Client 1.0");
//                connection.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
//
//                outputStream = new DataOutputStream(connection.getOutputStream());
//                outputStream.writeBytes(twoHyphens + boundary + lineEnd);
////                outputStream.writeBytes("Content-Disposition: form-data; name=" + "Photo" + ";filename=\""
////                        + fileName + "\"" + lineEnd);
//                outputStream.writeBytes("Content-Disposition: form-data; name=\"" + "Photo" + "\"; filename=\"" + file.getName() + "\"" + lineEnd);
//                outputStream.writeBytes("Content-Type: " + getMimeType(file) + lineEnd);
//                outputStream.writeBytes("Content-Transfer-Encoding: binary" + lineEnd);
//
//                outputStream.writeBytes(lineEnd);
//
//                bytesAvailable = fileInputStream.available();
//                bufferSize = Math.min(bytesAvailable, maxBufferSize);
//                buffer = new byte[bufferSize];
//
//                bytesRead = fileInputStream.read(buffer, 0, bufferSize);
//                while (bytesRead > 0) {
//                    outputStream.write(buffer, 0, bufferSize);
//                    bytesAvailable = fileInputStream.available();
//                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
//                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);
//                }
//
//                outputStream.writeBytes(lineEnd);
//
//                // Upload POST Data
//                Iterator<String> keys = parmas.keySet().iterator();
//                while (keys.hasNext()) {
//                    String key = keys.next();
//                    String value = parmas.get(key);
//
//                    outputStream.writeBytes(twoHyphens + boundary + lineEnd);
//                    outputStream.writeBytes("Content-Disposition: form-data; name=\"" + key + "\"" + lineEnd);
//                    outputStream.writeBytes("Content-Type: text/plain" + lineEnd);
//                    outputStream.writeBytes(lineEnd);
//                    outputStream.writeBytes(value);
//                    outputStream.writeBytes(lineEnd);
//                }
//
//                outputStream.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);
//
//
//                if (200 != connection.getResponseCode()) {
//                    throw new Exception("Failed to upload code:" + connection.getResponseCode() + " " + connection.getResponseMessage());
//                }
//
//                inputStream = connection.getInputStream();
//
//                result = this.convertStreamToString(inputStream);
//
//                fileInputStream.close();
//                inputStream.close();
//                outputStream.flush();
//                outputStream.close();
//
//                return result;
//            } catch (Exception e) {
//                throw new Exception(e);
//            }
//
//        }

        private String convertStreamToString(InputStream is) {
            BufferedReader reader = new BufferedReader(new InputStreamReader(is));
            StringBuilder sb = new StringBuilder();

            String line = null;
            try {
                while ((line = reader.readLine()) != null) {
                    sb.append(line);
                }
            } catch (IOException e) {
                e.printStackTrace();
            } finally {
                try {
                    is.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return sb.toString();
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            try {
                if (activity != null) {
                    activity.runOnUiThread(new Runnable() {

                        @Override
                        public void run() {
                            ProgressDialogUtil.showDialog(activity);
                        }
                    });
                }
            } catch (Exception e) {
                e.printStackTrace();
                Log.e("TAGT", "Exception: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            try {
                if (activity != null) {
                    activity.runOnUiThread(new Runnable() {

                        @Override
                        public void run() {
                            ProgressDialogUtil.hideDialog();
                        }
                    });
                }
                if (onresult != null && result != null) {
                    Log.v("TAGT", "l RESPONSE:" + result);
                    onresult.sendData(result, "flag");
                } else
                    Log.v("TAGT", "RESPONSE:" + result);
            } catch (Exception e) {
                e.printStackTrace();
                Log.e("TAGT", "Exception: " + e.getMessage());
            }
        }

    }

    private static String getExtention(String fileName) {
        char[] arrayOfFilename = fileName.toCharArray();
        for (int i = arrayOfFilename.length - 1; i > 0; i--) {
            if (arrayOfFilename[i] == '.') {
                return fileName.substring(i + 1, fileName.length());
            }
        }
        return "";
    }

    public static String getMimeType(File file) {
        String mimeType = "";
        String extension = getExtention(file.getName());
        if (MimeTypeMap.getSingleton().hasExtension(extension)) {
            mimeType = MimeTypeMap.getSingleton().getMimeTypeFromExtension(extension);
        }
        return mimeType;
    }

}
