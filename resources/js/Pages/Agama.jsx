import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm } from "@inertiajs/react";
import { useState, useEffect } from "react";

import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Button } from "@/Components/ui/button";
import { Pencil, Trash2 } from "lucide-react";

import { createColumnHelper } from "@tanstack/react-table";

import { GenericTable } from "@/Components/GenericTable";
import Swal from "sweetalert2";

export default function Agama({ datas }) {
    const [showEditModal, setShowEditModal] = useState(false);

    const { data, setData, post,put,processing, errors, reset } = useForm({
        nama_agama: "",
        jumlah_penduduk: "",
    });
    // console.log(data);
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
    const handleSubmit = (e) => {
        
        e.preventDefault();
        // console.log("add",data);
        post(route("agamas.store"), {
            onSuccess: () => {
                reset();
                Toast.fire({
                    icon: "success",
                    title: "Berhasil menambahkan"
                })
                document.getElementById('closeDialogAdd').click();
            },
            onError: () => {
                // reset();
                setData({
                    nama_agama: "",
                    jumlah_penduduk: ""
                })
                Toast.fire({
                    icon: "error",
                    title: "Gagal menambahkan"
                })  
            }
        });
    };

    const columnHelper = createColumnHelper();
    const column = [
        columnHelper.accessor("nama_agama", {
            header: "Agama",
            cell: (info) => (
                <span className="font-medium">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("jumlah_penduduk", {
            header: "Jumlah penduduk",
            cell: (info) => (
                <span className="font-medium">{info.getValue()}</span>
            ),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                // const [showEditModal, setShowEditModal] = useState(false);
                // console.log("row:", row.original.id);
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            className="bg-gray-200"
                            size="icon"
                            onClick={() => {
                                reset();
                                setData(row.original);
                                setShowEditModal(true)
                            
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
                                                "agamas.destroy",
                                                row.original.id_agama
                                            ),
                                            {
                                                onSuccess: () => {
                                                    Toast.fire({
                                                        icon: "success",
                                                        title: "Berhasil dihapus",
                                                    });
                                                },
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

    const handleEditSubmit = (e) => {
        e.preventDefault();
        // console.log("data yang akan di edit",data);
        put(route('agamas.update', data?.id_agama), {
            onSuccess: () => {
                reset();
                setShowEditModal(false);
                Toast.fire({
                    icon: "success",
                    title: "Berhasil mengubah"
                })
            },
            onError: () => {
                Toast.fire({
                    icon: "error",
                    title: "Gagal mengubah"
                })  
            }
        })
    }
    const handleRowClick = (staff) => {
        // console.log(data);
        // setData(staff);
        // console.log("Staff dipilih:", data);
        // Navigasi ke halaman detail atau modal
        // router.push(`/staff/${staff.id}`);
    };
    return (
        <AuthenticatedLayout headerName="Agama">
            <Head title="Agama" />
            <div className="container mx-auto py-8">
                <div className="flex justify-between  items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Data Agama
                        </h1>
                        <p className="text-gray-600 ">
                            Lihat data penduduk yang memiliki agama
                        </p>
                    </div>
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
                            <div className="grid gap-4">
                                <div className="grid gap-3">
                                    <Label htmlFor="agama">Agama</Label>
                                    <Input
                                        id="agama"
                                        name="nama_agama"
                                        value={data.nama_agama}
                                        onChange={(e) =>
                                            setData(
                                                "nama_agama",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh : Islam, katolik, dll"
                                    />
                                    {errors.nama_agama && (
                                        <p className="text-sm text-red-500">
                                            {errors.nama_agama}
                                        </p>
                                    )}
                                </div>

                                <div className="grid gap-3">
                                    <Label htmlFor="jumlah">
                                        Jumlah penduduk
                                    </Label>
                                    <Input
                                        type="number"
                                        inputMode="numeric"
                                        pattern="[0-9]*"
                                        id="jumlah"
                                        name="jumlah_penduduk"
                                        value={data.jumlah_penduduk}
                                        onChange={(e) =>
                                            setData(
                                                "jumlah_penduduk",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh : 10"
                                    />
                                    {errors.jumlah_penduduk && (
                                        <p className="text-sm text-red-500">
                                            {errors.jumlah_penduduk}
                                        </p>
                                    )}
                                </div>
                            </div>

                            <DialogFooter>
                                <DialogClose asChild>
                                    <Button type="button" variant="outline" id="closeDialogAdd">
                                        Cancel
                                    </Button>
                                </DialogClose>
                                <Button
                                    type="submit"
                                    onClick={(e) => {
                                        e.preventDefault();
                                        handleSubmit(e);
                                    }}
                                >
                                    simpan
                                </Button>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>
                </div>
                <GenericTable
                    data={datas}
                    columns={column}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
                <div className="mt-4 text-sm text-gray-500">
                    Total {datas.length} Agama terdaftar
                </div>
            </div>

            {showEditModal && (
                <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Edit data Agama</DialogTitle>
                            <DialogDescription>Ubah jumlah penduduk yang memiliki agama</DialogDescription>
                        </DialogHeader>
                        <div className="grid gap-4">
                                <div className="grid gap-3">
                                    <Label htmlFor="agama">Agama</Label>
                                    <Input
                                        id="agama"
                                        name="nama_agama"
                                        value={data.nama_agama}
                                        onChange={(e) =>
                                            setData(
                                                "nama_agama",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh : Islam, katolik, dll"
                                    />
                                    {errors.nama_agama && (
                                        <p className="text-sm text-red-500">
                                            {errors.nama_agama}
                                        </p>
                                    )}
                                </div>

                                <div className="grid gap-3">
                                    <Label htmlFor="jumlah">
                                        Jumlah penduduk
                                    </Label>
                                    <Input
                                        type="number"
                                        inputMode="numeric"
                                        pattern="[0-9]*"
                                        id="jumlah"
                                        name="jumlah_penduduk"
                                        value={data.jumlah_penduduk}
                                        onChange={(e) =>
                                            setData(
                                                "jumlah_penduduk",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh : 10"
                                    />
                                    {errors.jumlah_penduduk && (
                                        <p className="text-sm text-red-500">
                                            {errors.jumlah_penduduk}
                                        </p>
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
                            <Button
                                type="submit"
                                onClick={(e) => {
                                    e.preventDefault();
                                    handleEditSubmit(e);
                                }}
                            >
                                simpan
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
            )}
        </AuthenticatedLayout>
    );
}
