import { Head, useForm } from "@inertiajs/react";
import ReactQuill from "react-quill";
import "react-quill/dist/quill.snow.css";
import { useState } from "react";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

const CreateBerita = ({ datas, onClose, onOpen }) => {
    const [open, setOpen] = useState(false);
    const { data, setData, post, processing, errors } = useForm({
        judul: "",
        isi: "",
        excerpt: "",
        kategori: "",
    });

    // Konfigurasi toolbar Quill.js yang simpel
    const modules = {
        toolbar: [
            [{ header: [1, 2, 3, false] }],
            ["bold", "italic", "underline", "strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            ["link", "image"],
            ["blockquote"],
            ["clean"],
        ],
    };

    const formats = [
        "header",
        "bold",
        "italic",
        "underline",
        "strike",
        "list",
        "bullet",
        "link",
        "image",
        "blockquote",
    ];

    const submit = (e) => {
        e.preventDefault();
        // post(route('berita.store'))
        console.log(data);
    };

    return (
        <Dialog>
        <DialogTrigger asChild>
            <Button variant="default">Tambah Data</Button>
        </DialogTrigger>
        <DialogContent className="sm:max-w-[525px]">
            <DialogHeader>
                <DialogTitle>Tambah data Agama</DialogTitle>
                <DialogDescription>
                    Isi form berikut untuk menambahkan data
                    baru.
                </DialogDescription>
            </DialogHeader>
        
                <form onSubmit={submit} className="space-y-6">
                    {/* Input Judul */}
                    <div>
                        <label className="block text-sm font-medium mb-2">
                            Judul Berita
                        </label>
                        <input
                            type="text"
                            value={data.judul}
                            onChange={(e) => setData("judul", e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan judul berita..."
                        />
                        {errors.judul && (
                            <div className="text-red-500 text-sm mt-1">
                                {errors.judul}
                            </div>
                        )}
                    </div>

                    {/* Input Kategori */}
                    <div>
                        <label className="block text-sm font-medium mb-2">
                            Kategori
                        </label>
                        <select
                            value={data.kategori}
                            onChange={(e) =>
                                setData("kategori", e.target.value)
                            }
                            className="w-full p-3 border border-gray-300 rounded-md"
                        >
                            <option value="">Pilih Kategori</option>
                            <option value="politik">Politik</option>
                            <option value="ekonomi">Ekonomi</option>
                            <option value="olahraga">Olahraga</option>
                            <option value="teknologi">Teknologi</option>
                        </select>
                    </div>

                    {/* Text Editor Quill.js */}
                    <div>
                        <label className="block text-sm font-medium mb-2">
                            Isi Berita
                        </label>
                        <ReactQuill
                            theme="snow"
                            value={data.isi}
                            onChange={(content) => setData("isi", content)}
                            modules={modules}
                            formats={formats}
                            placeholder="Tulis isi berita Anda di sini..."
                            className="h-64 mb-12"
                        />
                        {errors.isi && (
                            <div className="text-red-500 text-sm mt-1">
                                {errors.isi}
                            </div>
                        )}
                    </div>

                    {/* Submit Button */}
                    <div className="flex gap-4">
                        <button
                            type="submit"
                            disabled={processing}
                            className="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50"
                        >
                            {processing ? "Menyimpan..." : "Simpan Berita"}
                        </button>

                        <a
                            //   href={route('berita.index')}
                            className="px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
    );
};

export default CreateBerita;
