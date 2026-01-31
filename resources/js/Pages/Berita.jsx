import { useState, useEffect, useRef } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm } from "@inertiajs/react";
import { format, parse } from "date-fns";
import { id } from "date-fns/locale";
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
import ReactQuill from "react-quill";
import "react-quill/dist/quill.snow.css";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover";
import { Calendar } from "@/components/ui/calendar";
import { CalendarIcon } from "lucide-react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Pencil, Trash2, Image as ImageIcon } from "lucide-react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import Swal from "sweetalert2";

// Toast notification setup
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

export default function Berita({ datas }) {
    // console.log(datas);
    const [openModal, setOpenModal] = useState(false);
    const [openEditModal, setOpenEditModal] = useState(false);
    const [showEditModal, setShowEditModal] = useState(false);
       const [editFormData, setEditFormData] = useState({
        id_berita: "",
        judul: "",
        isi: "",
        gambar: null, // untuk file baru
        existing_gambar: "", // untuk path gambar lama
    });
    const [imagePreview, setImagePreview] = useState(null);
    const fileInputRef = useRef(null);


    const { data, setData, post, processing, errors, reset } = useForm({
        judul: "",
        isi: "",
        gambar: null,
    });

    // Konfigurasi toolbar Quill.js dengan image handler
    const modules = {
        toolbar: {
            container: [
                [{ header: [1, 2, 3, false] }],
                ["bold", "italic", "underline", "strike"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["link", "image"],
                ["blockquote"],
                ["clean"],
            ],
        },
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

    // Handle image upload untuk Quill
    const handleImageUpload = () => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = async () => {
            const file = input.files[0];
            if (file) {
                // Simpan file ke form data utama
                setData('gambar', file);
                
                // Create preview untuk Quill
                const reader = new FileReader();
                reader.onload = (e) => {
                    // Untuk preview di form, bukan di Quill content
                    setImagePreview(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        };
    };

    // Enhanced modules dengan image handler
    const enhancedModules = {
        ...modules,
        toolbar: {
            ...modules.toolbar,
            handlers: {
                image: handleImageUpload
            }
        }
    };
  const handleEditClick = (berita) => {
        setShowEditModal(true);
        setEditFormData({
            id_berita: berita.id_berita,
            judul: berita.judul_berita,
            isi: berita.isi_berita,
            gambar: null, // reset file baru
            existing_gambar: berita.url_gambar, // simpan path gambar lama
        });
        setImagePreview(berita.url_gambar); // sudah full URL dari controller
    };
     const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setData('gambar', file);
            
            // Create preview
            const reader = new FileReader();
            reader.onload = (e) => {
                setImagePreview(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    };
    // Handle file input change
    const handleEditFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setEditFormData({
                ...editFormData,
                gambar: file, // set file baru
                existing_gambar: "" // reset existing gambar karena ada file baru
            });
            
            // Create preview
            const reader = new FileReader();
            reader.onload = (e) => setImagePreview(e.target.result);
            reader.readAsDataURL(file);
        }
    };
    // Remove image preview
  const removeImagePreview = () => {
        setImagePreview(null);
        setData('gambar', null);
        // Reset file input
        const fileInput = document.getElementById('gambar');
        if (fileInput) fileInput.value = '';
    };
  const removeEditImagePreview = () => {
        setImagePreview(null);
        setEditFormData({
            ...editFormData,
            gambar: null,
            existing_gambar: "" // hapus juga existing gambar
        });
        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
    };

    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("judul_berita", {
            header: "Judul Berita",
            cell: (info) => (
                <div className="font-medium">{info.getValue()}</div>
            ),
        }),
        columnHelper.accessor("isi_berita", {
            header: "Isi Berita",
            cell: (info) => {
                const content = info.getValue();
                return (
                    <div 
                        className="max-w-md truncate"
                        dangerouslySetInnerHTML={{ __html: content }}
                    />
                );
            },
        }),
        columnHelper.accessor("url_gambar", {
            header: "Gambar",
            cell: (info) => {
                const gambar = info.getValue();
                console.log(gambar)
                return gambar ? (
                    <img 
                        src={`/storage/${gambar}`} 
                        alt="Gambar berita" 
                        className="w-16 h-16 object-cover rounded"
                    />
                ) : (
                    <div className="text-gray-400">No Image</div>
                );
            },
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            className="bg-yellow-100 hover:bg-yellow-200"
                            size="icon"
                            onClick={() => {
                                const berita = row.original;
                                handleEditClick(berita);
                            }}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <Button
                            variant="destructive"
                            size="icon"
                            onClick={() => {
                                Swal.fire({
                                    title: "Yakin ingin menghapus berita ini?",
                                    text: "Data yang dihapus tidak dapat dikembalikan!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Ya, Hapus!",
                                    cancelButtonText: "Batal"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        router.delete(
                                            route("Berita.destroy", row.original.id_berita),
                                            {
                                                onSuccess: () => {
                                                    Toast.fire({
                                                        icon: "success",
                                                        title: "Berita berhasil dihapus",
                                                    });
                                                },
                                                onError: () => {
                                                    Toast.fire({
                                                        icon: "error",
                                                        title: "Gagal menghapus berita",
                                                    });
                                                },
                                            }
                                        );
                                    }
                                });
                            }}
                        >
                            <Trash2 className="h-4 w-4" />
                        </Button>
                    </div>
                );
            },
        }),
    ];

    const handleRowClick = (row) => {
        // console.log('Row clicked:', row);
    };

    // Handle create form submission
    const handleSubmit = (e) => {
        e.preventDefault();
        // // Validasi form
        if (!data.judul.trim() || !data.isi.trim()) {
            Toast.fire({
                icon: 'error',
                title: 'Judul dan isi berita harus diisi'
            });
            return;
        }

        post(route('Berita.store'), {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Berita berhasil ditambahkan",
                });
                // Reset form
                reset();
                setImagePreview(null);
                setOpenModal(false);
                
            },
            onError: (errors) => {
                console.log(errors);
                Toast.fire({
                    icon: "error",
                    title: "Gagal menambahkan berita",
                });
            },
            preserveScroll: true,
        });
    };

    // Handle update form submission
     const handleUpdate = (e) => {
        e.preventDefault();
        
        // Create FormData untuk handle file upload
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('judul', editFormData.judul);
        formData.append('isi', editFormData.isi);
        
        // Jika ada file baru, append file. Jika tidak, append existing_gambar
        if (editFormData.gambar) {
            formData.append('gambar', editFormData.gambar);
        } else if (editFormData.existing_gambar) {
            // Extract filename dari full URL jika perlu
            const gambarPath = editFormData.existing_gambar.replace('/storage/', '');
            formData.append('existing_gambar', gambarPath);
        }
        
        // Juga append flag untuk hapus gambar
        if (!editFormData.gambar && !editFormData.existing_gambar) {
            formData.append('remove_gambar', 'true');
        }

        router.post(route("Berita.update", editFormData.id_berita), formData, {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Berita berhasil diupdate",
                });
                setShowEditModal(false);
                setImagePreview(null);
            },
            onError: (errors) => {
                console.error('Update errors:', errors);
                Toast.fire({
                    icon: "error",
                    title: "Gagal mengupdate berita",
                });
            },
        });
    };
    return (
        <AuthenticatedLayout headerName="Berita">
            <Head title="Berita" />
            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Data Berita
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola data Berita
                        </p>
                    </div>
                    <Dialog open={openModal} onOpenChange={setOpenModal}>
                        <DialogTrigger asChild>
                            <Button variant="default">Tambah Berita</Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[625px] md:min-w-[700px] max-h-[75vh] overflow-y-auto">
                            <DialogHeader>
                                <DialogTitle>Tambah Berita Baru</DialogTitle>
                                <DialogDescription>
                                    Isi form berikut untuk menambahkan berita baru.
                                </DialogDescription>
                            </DialogHeader>

                            <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                                <div>
                                    <label className="block text-sm font-medium mb-2">
                                        Judul Berita *
                                    </label>
                                    <Input
                                        type="text"
                                        value={data.judul}
                                        onChange={(e) => setData("judul", e.target.value)}
                                        placeholder="Masukkan judul berita..."
                                        className="w-full"
                                    />
                                    {errors.judul && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.judul}
                                        </div>
                                    )}
                                </div>

                                <div>
                                    <label className="flex items-center gap-2 text-sm font-medium mb-2">
                                        <ImageIcon className="w-4 h-4" />
                                        Gambar Utama
                                    </label>
                                    <div className="">

                                    <Input
                                        id="gambar"
                                        type="file"
                                        accept="image/*"
                                        onChange={handleFileChange}
                                        className="mt-1"
                                        />
                                    {errors.gambar && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.gambar}
                                        </div>
                                    )}
                                    
                                    {/* Image Preview */}
                                    {imagePreview && (
                                        <div className="mt-3 relative inline-block">
                                            <img 
                                                src={imagePreview} 
                                                alt="Preview" 
                                                className="w-24 h-24 object-cover rounded border"
                                            />
                                            <button
                                                type="button"
                                                onClick={removeImagePreview}
                                                className="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                            >
                                                ×
                                            </button>
                                        </div>
                                    )}
                                        </div>
                                </div>

                                {/* Text Editor Quill.js */}
                                <div className="mb-5">
                                    <label className="block text-sm font-medium mb-2">
                                        Isi Berita *
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
                                <DialogFooter>
                                    <DialogClose asChild>
                                        <Button type="button" variant="outline">
                                            Batal
                                        </Button>
                                    </DialogClose>
                                    <Button 
                                        type="submit" 
                                        disabled={processing}
                                        className="bg-blue-600 hover:bg-blue-700"
                                    >
                                        {processing ? "Menyimpan..." : "Simpan Berita"}
                                    </Button>
                                </DialogFooter>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>

                {/* Table */}
                <GenericTable
                    data={datas}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />

                {/* Edit Modal */}
                 <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
        <DialogContent className="sm:max-w-[625px] md:min-w-[700px] max-h-[90vh] overflow-y-auto">
            <DialogHeader>
                <DialogTitle>Edit Berita</DialogTitle>
                <DialogDescription>
                    Edit data berita yang dipilih.
                </DialogDescription>
            </DialogHeader>

            <form onSubmit={handleUpdate} className="flex flex-col gap-4">
                <div>
                    <label className="block text-sm font-medium mb-2">
                        Judul Berita *
                    </label>
                    <Input
                        type="text"
                        value={editFormData.judul}
                        onChange={(e) => setEditFormData({...editFormData, judul: e.target.value})}
                        placeholder="Masukkan judul berita..."
                        className="w-full"
                    />
                </div>

                <div>
                    <label className="flex items-center gap-2 text-sm font-medium mb-2">
                        <ImageIcon className="w-4 h-4" />
                        Gambar Utama

                        {editFormData.existing_gambar && (
                            <span className="text-xs text-green-600">
                                (Gambar lama tersedia)
                            </span>
                        )}
                    </label>
                    {/* <span className="text-xs italic text-gray-500">max 20 Mb</span> */}
                    
                    <Input
                        ref={fileInputRef}
                        type="file"
                        accept="image/*"
                        onChange={handleEditFileChange}
                        className="mt-1"
                    />
                    
                    {/* Info gambar saat ini */}
                    {editFormData.existing_gambar && !editFormData.gambar && (
                        <div className="mt-2 text-sm text-gray-600">
                            <p>Gambar saat ini:</p>
                            <img 
                                src={`/storage/${editFormData.existing_gambar}`} 
                                alt="Current" 
                                className="w-20 h-20 object-cover rounded mt-1"
                            />
                            <button
                                type="button"
                                onClick={() => {
                                    setEditFormData({
                                        ...editFormData,
                                        existing_gambar: "",
                                        gambar: null
                                    });
                                    setImagePreview(null);
                                }}
                                className="text-red-500 text-xs mt-1 hover:text-red-700"
                            >
                                Hapus gambar ini
                            </button>
                        </div>
                    )}
                    
                    {/* Image Preview untuk file baru */}
                    {imagePreview && editFormData.gambar && (
                        <div className="mt-3 relative inline-block">
                            <img 
                                src={imagePreview} 
                                alt="Preview" 
                                className="w-32 h-32 object-cover rounded border"
                            />
                            <button
                                type="button"
                                onClick={removeEditImagePreview}
                                className="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs"
                            >
                                ×
                            </button>
                        </div>
                    )}
                </div>

                {/* Text Editor Quill.js untuk Edit */}
                <div className="mb-5">
                    <label className="block text-sm font-medium mb-2">
                        Isi Berita *
                    </label>
                    <ReactQuill
                        theme="snow"
                        value={editFormData.isi}
                        onChange={(content) => setEditFormData({...editFormData, isi: content})}
                        modules={modules}
                        formats={formats}
                        placeholder="Tulis isi berita Anda di sini..."
                        className="h-64 mb-12"
                    />
                </div>

                {/* Submit Button */}
                <DialogFooter>
                    <Button 
                        type="button" 
                        variant="outline"
                        onClick={() => {
                            setShowEditModal(false);
                            setImagePreview(null);
                        }}
                    >
                        Batal
                    </Button>
                    <Button 
                        type="submit" 
                        className="bg-blue-600 hover:bg-blue-700"
                    >
                        Update Berita
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
            </div>
        </AuthenticatedLayout>
    );
}