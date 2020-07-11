package app.student.attendance.com.teacherapp;

import android.app.Application;
import android.graphics.Bitmap;
import android.text.TextUtils;
import android.util.LruCache;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.Volley;

import app.student.attendance.com.teacherapp.Utility.TypefaceUtil;


/**
 * application class
 */

public class App extends Application {
    public static final String TAG = App.class
            .getSimpleName();
    private static App mInstance;
    private RequestQueue mRequestQueue;

    public static synchronized App getInstance() {
        return mInstance;
    }
    private ImageLoader imageLoader;

    @Override
    public void onCreate() {
        super.onCreate();

        mInstance = this;
        try {
            TypefaceUtil.setDefaultFont(this, "MONOSPACE", "NOTOSANS.TTF");
            TypefaceUtil.setDefaultFont(this, "SERIF", "NOTOSANS.TTF");
            TypefaceUtil.setDefaultFont(this, "SANS_SERIF", "NOTOSANS.TTF");
            TypefaceUtil.setDefaultFont(this, "DEFAULT", "NOTOSANS.TTF");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    public ImageLoader getImageLoader() {
        getRequestQueue();
        if (imageLoader == null) {
            imageLoader = new ImageLoader(this.mRequestQueue, new ImageLoader.ImageCache() {

                private final LruCache<String, Bitmap> mCache = new LruCache<String, Bitmap>(10);

                public Bitmap getBitmap(String url) {
                    return mCache.get(url);
                }

                @Override
                public void putBitmap(String url, Bitmap bitmap) {
                    mCache.put(url, bitmap);
                }

            });
        }

        return this.imageLoader;
    }
    public RequestQueue getRequestQueue() {
        if (mRequestQueue == null) {
            mRequestQueue = Volley.newRequestQueue(getApplicationContext());
        }
        return mRequestQueue;
    }

    public <T> void addToRequestQueue(Request<T> req, String tag) {
        // set the default tag if tag is empty
        req.setTag(TextUtils.isEmpty(tag) ? TAG : tag);
        getRequestQueue().add(req);
    }

    public <T> void addToRequestQueue(Request<T> req) {
        req.setRetryPolicy(new DefaultRetryPolicy(DefaultRetryPolicy.DEFAULT_TIMEOUT_MS * 20, 0, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
        req.setTag(TAG);
        getRequestQueue().add(req);
    }

    public void cancelPendingRequests(Object tag) {
        if (mRequestQueue != null) {
            mRequestQueue.cancelAll(tag);
        }
    }
}
