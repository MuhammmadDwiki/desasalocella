
import { useState, useEffect } from "react";
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
import { Pencil, Trash2 } from "lucide-react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import Swal from "sweetalert2";
export default function KarangTaruna({datas}) {
    const [showEditModal, setShowEditModal] = useState(false);
    const [editData, setEditData] = useState(null);

    // Form for creating new data
    const {
        data: createData,
        setData: setCreateData,
        post,
        processing: creating,
        errors: createErrors,
        reset: resetCreate,
    } = useForm({
        nama_anggota: "",
        jabatan: "",
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
        id_karangtaruna: "",
        nama_anggota: "",
        jabatan: "",
    });

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
        columnHelper.accessor("nama_anggota", {
            header: "Nama Anggota",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jabatan", {
            header: "Status dalam organisasi",
            cell: (info) => info.getValue(),
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
                                    id_karangtaruna: row.original.id_karangtaruna,
                                    nama_anggota: row.original.nama_anggota,
                                    jabatan:
                                        row.original.jabatan,
                                   
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
                                                "karangTarunas.destroy",
                                                row.original.id_karangtaruna
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
        post(route("karangTarunas.store"), {
            onSuccess: () => {
                resetCreate("nama_anggota","jabatan")
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
        // console.log('editData', editFormData)
        put(route("karangTarunas.update", editFormData.id_karangtaruna), {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Data berhasil diupdate",
                });
                setShowEditModal(false);
            },
            onError: () => {
                Toast.fire({
                    icon: "error",
                    title: "Data gagal diupdate",
                });
            },
        });
    };

    return (
        <AuthenticatedLayout headerName="Karang Taruna">
            <Head title="Karang Taruna" />
            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Data Karang Taruna
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola data karang taruna

                        </p>
                    </div>
                    <Dialog>
                        <DialogTrigger asChild>
                            <Button
                                variant="default"
                                // onClick={() => resetCreate("nama_anggota","jabatan")}
                            >
                                Tambah Data
                            </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[525px]">
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
                                    <label className="block text-sm font-medium text-gray-700">
                                        Nama Anggota
                                    </label>
                                    <Input
                                        value={createData.nama_anggota}
                                        onChange={(e) =>
                                            setCreateData(
                                                "nama_anggota",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh: Budi"
                                    />
                                    {createErrors.nama_anggota && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.nama_anggota}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700">
                                        Status dalam Organisasi
                                    </label>
                                    <Input
                                        value={createData.jabatan}
                                        onChange={(e) =>
                                            setCreateData(
                                                "jabatan",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh: ketua I, sekretaris, anggota, dll"
                                    />
                                    {createErrors.jabatan && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.jabatan}
                                        </p>
                                    )}
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
                                <label className="block text-sm font-medium text-gray-700">
                                    Nama Kegiatan
                                </label>
                                <Input
                                    value={editFormData.nama_anggota}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "nama_anggota",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: Karang Taruna"
                                />
                                {updateErrors.nama_anggota && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.nama_anggota}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Status dalam Organisasi

                                </label>
                                <Input
                                    value={editFormData.jabatan}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "jabatan",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: lapangan, balai desa, dll"
                                />
                                {updateErrors.jabatan && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.jabatan}
                                    </p>
                                )}
                            </div>


                            <DialogFooter>
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => setShowEditModal(false)}
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
    );
}