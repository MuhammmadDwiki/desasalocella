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

export default function PerangkatDesa({ datas }) {
    const [showEditModal, setShowEditModal] = useState(false);
    const [editData, setEditData] = useState(null);
    const [imagePreview, setImagePreview] = useState(null);
    const fileInputRef = useRef(null);
    
    // Form for creating new data
    const {
        data: createData,
        setData: setCreateData,
        post,
        processing: creating,
        errors: createErrors,
        reset: resetCreate,
    } = useForm({
        nama_pd: "",
        jabatan_pd: "",
        pendidikan_pd: "",
        tempat_tanggal_lahir_pd: "",
        agama_pd: "",
        alamat_pd: "",
        url_foto_profil: null,

    });

    // Form for editing existing data
    const {
        data: editFormData,
        setData: setEditFormData,
        put,
        processing: updating,
        errors: updateErrors,
        reset: resetEdit,
    } = useForm({
        id_prDesa: "",
        nama_pd: "",
        jabatan_pd: "",
        pendidikan_pd: "",
        tempat_tanggal_lahir_pd: "",
        agama_pd: "",
        alamat_pd: "",
        url_foto_profil: null,
        existing_url_foto_profil: "",
        
    });
    console.log(imagePreview, editFormData.existing_url_foto_profil);

    // console.log(editFormData.existing_url_foto_profil)


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
     const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setCreateData('url_foto_profil', file);
            
            // Create preview
            const reader = new FileReader();
            reader.onload = (e) => {
                setImagePreview(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    };

      // Remove image preview
    const removeImagePreview = () => {
            setImagePreview(null);
            setCreateData('url_foto_profil', null);
            // Reset file input
            const fileInput = document.getElementById('gambar');
            if (fileInput) fileInput.value = '';
        };
    const removeEditImagePreview = () => {
            setImagePreview(null);
            setEditFormData({
                ...editFormData,
                url_foto_profil: null,
                existing_url_foto_profil: "" // hapus juga existing gambar
            });
            if (fileInputRef.current) {
                fileInputRef.current.value = '';
            }
        };
 const handleEditFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setEditFormData({
                ...editFormData,
                url_foto_profil: file, // set file baru
                existing_url_foto_profil: "" // reset existing gambar karena ada file baru
            });
            
            // Create preview
            const reader = new FileReader();
            reader.onload = (e) => setImagePreview(e.target.result);
            reader.readAsDataURL(file);
        }
    };
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });

     const columnHelper = createColumnHelper();
        const columns = [
            columnHelper.accessor("nama_pd", {
                header: "Nama",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("jabatan_pd", {
                header: "Jabatan",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("pendidikan_pd", {
                header: "Pendidikan",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("tempat_tanggal_lahir_pd", {
                header: "Tempat/tanggal Lahir",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("agama_pd", {
                header: "Agama",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("alamat_pd", {
                header: "Alamat",
                cell: (info) => info.getValue(),
            }),
            columnHelper.accessor("url_foto_profil", {
            header: "Foto",
            cell: (info) => {
                const gambar = info.getValue();
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
                                className="bg-gray-200"
                                size="icon"
                                onClick={() => {
                                    setShowEditModal(true);
                                    setEditFormData({
                                        id_prDesa: row.original.id_prDesa,
                                        nama_pd: row.original.nama_pd,
                                        jabatan_pd:  row.original.jabatan_pd,
                                        pendidikan_pd:  row.original.pendidikan_pd,
                                        tempat_tanggal_lahir_pd:  row.original.tempat_tanggal_lahir_pd,
                                        agama_pd:  row.original.agama_pd,
                                        alamat_pd:  row.original.alamat_pd,
                                         url_foto_profil: null,
                                        existing_url_foto_profil: row.original.url_foto_profil,
                                    });
                                }}
                            >
                                <Pencil className="h-4 w-4" />
                            </Button>
                            <Button
                                variant="destructive"
                                size="icon"
                                onClick={(e) => {
                                    // console.log(row.original.id_rt)
                                    // e.stopPropagation();
                                    // handleDelete(row.original.id);
                                    Swal.fire({
                                        title: "yakin ingin menghapus ini ?",
                                        showConfirmButton: true,
                                        showCancelButton: true,
                                        confirmButtonText: "Ya",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Swal.fire("Saved!", "", "success");
                                            router.delete(
                                                route(
                                                    "perangkatDesas.destroy",
                                                    row.original.id_prDesa
                                                ),
                                                {
                                                    onSuccess: () => {
                                                        Toast.fire({
                                                            icon: "success",
                                                            title: "Berhasil dihapus",
                                                        });
                                                    },
                                                    onError: () => {
                                                        Toast.fire({
                                                            icon: "error",
                                                            title: "Gagal dihapus"
                                                        })
                                                    }
                                                }
                                            );
                                        }
                                    });
                                    // if (confirm("yakin ingin menghapus ini ?")) {
                                    // }
                                }}
                            >
                                <Trash2 className="h-4 w-4" />
                            </Button>
                        </div>
                    );
                },
            }),
        ];
        // console.log(editFormData);
    
        const handleRowClick = () => {};
    
        // Handle create form submission
        const handleCreate = (e) => {
            e.preventDefault();
            // console.log(createData)
            post(route("perangkatDesas.store"), {
                onSuccess: () => {
                    resetCreate();
                    Toast.fire({
                        icon: "success",
                        title: "Data berhasil ditambahkan",
                    });
                    document.getElementById("closeDialog").click();
                },
                onError: () => {
                    Toast.fire({
                        icon: "error",
                        title: "Data gagal ditambahkan",
                    });
                },
            });
        };
    
        // Handle update form submission
           const handleUpdate = (e) => {
                e.preventDefault();
      
                // Create FormData untuk handle file upload
                const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('nama_pd', editFormData.nama_pd);
                formData.append('jabatan_pd', editFormData.jabatan_pd);
                formData.append('pendidikan_pd', editFormData.pendidikan_pd);
                formData.append('tempat_tanggal_lahir_pd', editFormData.tempat_tanggal_lahir_pd);
                formData.append('agama_pd', editFormData.agama_pd);
                formData.append('alamat_pd', editFormData.alamat_pd);
                
                // Jika ada file baru, append file. Jika tidak, append existing_gambar
                if (editFormData.url_foto_profil) {
                    formData.append('url_foto_profil', editFormData.url_foto_profil);
                } else if (editFormData.existing_url_foto_profil) {
                    // Extract filename dari full URL jika perlu
                    const gambarPath = editFormData.existing_url_foto_profil.replace('/storage/', '');
                    formData.append('existing_url_foto_profil', gambarPath);
                }
                
                // Juga append flag untuk hapus gambar
                if (!editFormData.url_foto_profil && !editFormData.existing_url_foto_profil) {
                    formData.append('remove_gambar', 'true');
                }
                console.log(formData)
                router.post(route("perangkatDesas.update", editFormData.id_prDesa), formData, {
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "Perangkat desa berhasil diupdate",
                        });
                        setShowEditModal(false);
                        setImagePreview(null);
                    },
                    onError: (errors) => {
                        console.error('Update errors:', errors);
                        Toast.fire({
                            icon: "error",
                            title: "Gagal mengupdate Perangkat desa",
                        });
                    },
                });
            };
    

    // console.log(createData)
    return(

    <AuthenticatedLayout headerName="Perangkat Desa">
        <Head title="Perangkat Desa" />
        <div className="container mx-auto py-8">
            <div className="flex justify-between items-center mb-6">
                <div>
                    <h1 className="text-2xl font-bold text-gray-800">
                        Data Perangkat Desa
                    </h1>
                    <p className="text-gray-600">
                        Lihat dan kelola data Perangkat Desa

                    </p>
                </div>
                <Dialog>
                    <DialogTrigger asChild>
                        <Button
                            variant="default"
                            // onClick={() => resetCreate()}
                        >
                            Tambah Data
                        </Button>
                    </DialogTrigger>
                    <DialogContent className="sm:max-w-[525px] max-h-[75vh] overflow-y-auto">
                        <DialogHeader>
                            <DialogTitle className="capitalize">
                                Tambah data karang taruna
                            </DialogTitle>
                            <DialogDescription>
                                Isi form berikut untuk menambahkan data
                                baru.
                            </DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleCreate} className="space-y-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    Nama Lengkap
                                </label>
                                <Input
                                    value={createData.nama_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "nama_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="nama lengkap"
                                />
                                {createErrors.nama_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.nama_pd}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    jabatan
                                </label>
                                <Input
                                    value={createData.jabatan_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "jabatan_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: kepala desa, sekretaris, anggota, dll"
                                />
                                {createErrors.jabatan_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.jabatan_pd}
                                    </p>
                                )}
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    pendidikan
                                </label>
                                <Input
                                    value={createData.pendidikan_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "pendidikan_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: S1, SMA, dll"
                                />
                                {createErrors.pendidikan_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.pendidikan_pd}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    tempat/tanggal lahir
                                </label>
                                <Input
                                    value={createData.tempat_tanggal_lahir_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "tempat_tanggal_lahir_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="tempat tanggal lahir"
                                />
                                {createErrors.tempat_tanggal_lahir_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.tempat_tanggal_lahir_pd}
                                    </p>
                                )}
                            </div>
                            
                              
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    Agama
                                </label>
                                <Input
                                    value={createData.agama_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "agama_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="agama"
                                />
                                {createErrors.agama_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.agama_pd}
                                    </p>
                                )}
                            </div>
                              
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    alamat
                                </label>
                                <Input
                                    value={createData.alamat_pd}
                                    onChange={(e) =>
                                        setCreateData(
                                            "alamat_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="Alamat "
                                />
                                {createErrors.alamat_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.alamat_pd}
                                    </p>
                                )}
                            </div>
                            
                              <div>
                                    <label className="flex items-center gap-2 text-sm font-normal mb-2">
                                        <ImageIcon className="w-4 h-4" />
                                        Foto
                                    </label>
                                    <div className="">

                                    <Input
                                        id="gambar"
                                        type="file"
                                        accept="image/*"
                                        onChange={handleFileChange}
                                        className="mt-1"
                                        />
                                    <p className="text-xs text-gray-600 mt-1">* maksimal 20Mb</p>
                                    {createErrors.url_foto_profil && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {createErrors.url_foto_profil}
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


                            <DialogFooter>
                                <DialogClose asChild>
                                    <Button
                                        type="button"
                                        variant="outline"
                                        id="closeDialog"
                                    >
                                        Cancel
                                    </Button>
                                </DialogClose>
                                <Button type="submit" disabled={creating}>
                                    {creating ? "Menyimpan..." : "Simpan"}
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>
            <GenericTable
                data={datas}
                columns={columns}
                onRowClick={handleRowClick}
                pageSize={5}
            />
        </div>

        {showEditModal && (
            <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
                <DialogContent className="sm:max-w-[525px]">
                    <DialogHeader>
                        <DialogTitle className="capitalize">
                            Edit data kegiatan
                        </DialogTitle>
                        <DialogDescription>
                            Isi form berikut untuk mengubah data kegiatan.
                        </DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleUpdate} className="space-y-4">
                           <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    Nama Lengkap
                                </label>
                                <Input
                                    value={editFormData.nama_pd}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "nama_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="nama lengkap"
                                />
                                {createErrors.nama_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {createErrors.nama_pd}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    jabatan
                                </label>
                                <Input
                                    value={editFormData.jabatan_pd}
                                    onChange={(e) =>
                                        setEditData(
                                            "jabatan_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: kepala desa, sekretaris, anggota, dll"
                                />
                                {updateErrors.jabatan_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.jabatan_pd}
                                    </p>
                                )}
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    pendidikan
                                </label>
                                <Input
                                    value={editFormData.pendidikan_pd}
                                    onChange={(e) =>
                                        setEditData(
                                            "pendidikan_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: S1, SMA, dll"
                                />
                                {updateErrors.pendidikan_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.pendidikan_pd}
                                    </p>
                                )}
                            </div>
                            
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    tempat/tanggal lahir
                                </label>
                                <Input
                                    value={editFormData.tempat_tanggal_lahir_pd}
                                    onChange={(e) =>
                                        setEditData(
                                            "tempat_tanggal_lahir_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="tempat tanggal lahir"
                                />
                                {updateErrors.tempat_tanggal_lahir_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.tempat_tanggal_lahir_pd}
                                    </p>
                                )}
                            </div>
                            
                              
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    Agama
                                </label>
                                <Input
                                    value={editFormData.agama_pd}
                                    onChange={(e) =>
                                        setEditData(
                                            "agama_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="agama"
                                />
                                {updateErrors.agama_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.agama_pd}
                                    </p>
                                )}
                            </div>
                              
                            <div>
                                <label className="block text-sm font-medium text-gray-700 capitalize">
                                    alamat
                                </label>
                                <Input
                                    value={editFormData.alamat_pd}
                                    onChange={(e) =>
                                        setEditData(
                                            "alamat_pd",
                                            e.target.value
                                        )
                                    }
                                    placeholder="Alamat "
                                />
                                {updateErrors.alamat_pd && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.alamat_pd}
                                    </p>
                                )}
                            </div>
                            
                             
                <div>
                    <label className="flex items-center gap-2 text-sm font-medium mb-2">
                        <ImageIcon className="w-4 h-4" />
                        Gambar Utama

                        {editFormData.existing_url_foto_profil && (
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
                    {editFormData.existing_url_foto_profil && !editFormData.url_foto_profil && (
                        <div className="mt-2 text-sm text-gray-600">
                            <p>Gambar saat ini:</p>
                            <img 
                                src={`/storage/${editFormData.existing_url_foto_profil}`} 
                                alt="Current" 
                                className="w-20 h-20 object-cover rounded mt-1"
                            />
                            <button
                                type="button"
                                onClick={() => {
                                    setEditFormData({
                                        ...editFormData,
                                        existing_url_foto_profil: "",
                                        url_foto_profil: null
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
                    {imagePreview && editFormData.url_foto_profil && (
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


                        <DialogFooter>
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => {
                                    setShowEditModal(false)
                                    setImagePreview(null)
                                }}
                            >
                                Batal
                            </Button>
                            <Button type="submit" disabled={updating}>
                                {updating ? "Mengupdate..." : "Ubah"}
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        )}
    </AuthenticatedLayout>

    )
}