package com.kuncoro.kuncoronews.data;

/**
 * Created by Kuncoro on 29/02/2016.
 */
public class NewsData {
    private String id, judul, datetime, isi, gambar;

    public NewsData() {
    }

    public NewsData(String id, String judul, String datetime, String isi, String gambar) {
        this.id = id;
        this.judul = judul;
        this.datetime = datetime;
        this.gambar = gambar;
        this.isi = isi;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getJudul() {
        return judul;
    }

    public void setJudul(String judul) {
        this.judul = judul;
    }

    public String getGambar() {
        return gambar;
    }

    public void setGambar(String gambar) {
        this.gambar = gambar;
    }

    public String getDatetime() {
        return datetime;
    }

    public void setDatetime(String datetime) {
        this.datetime = datetime;
    }

    public String getIsi() {
        return isi;
    }

    public void setIsi(String isi) {
        this.isi = isi;
    }

}
