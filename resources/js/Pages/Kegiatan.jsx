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

export default function Kegiatan({ datas }) {
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
        nama_kegiatan: "",
        lokasi_kegiatan: "",
        tanggal_kegiatan: "",
        keterangan: "",
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
        id_kegiatan: "",
        nama_kegiatan: "",
        lokasi_kegiatan: "",
        tanggal_kegiatan: "",
        keterangan: "",
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
        columnHelper.accessor("nama_kegiatan", {
            header: "Nama kegiatan",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("lokasi_kegiatan", {
            header: "Lokasi Kegiatan",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("tanggal_kegiatan", {
            header: "Waktu Kegiatan",
            cell: (info) => format(info.getValue(), "PPP", { locale: id }),
        }),
        columnHelper.accessor("keterangan", {
            header: "Keterangan",
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
                                    id_kegiatan: row.original.id_kegiatan,
                                    nama_kegiatan: row.original.nama_kegiatan,
                                    lokasi_kegiatan:
                                        row.original.lokasi_kegiatan,
                                    tanggal_kegiatan:
                                        row.original.tanggal_kegiatan,
                                    keterangan:
                                        row.original.keterangan === "-"
                                            ? ""
                                            : row.original.keterangan,
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
                                                "kegiatans.destroy",
                                                row.original.id_kegiatan
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
    // console.log(editFormData);

    const handleRowClick = () => {};

    // Handle create form submission
    const handleCreate = (e) => {
        e.preventDefault();
        post(route("kegiatans.store"), {
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
        put(route("kegiatans.update", editFormData.id_kegiatan), {
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
        <AuthenticatedLayout headerName="Kegiatan">
            <Head title="Kegiatan" />
            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Data kegiatan
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola data Kegiatan
                        </p>
                    </div>
                    <Dialog>
                        <DialogTrigger asChild>
                            <Button
                                variant="default"
                                onClick={() => resetCreate()}
                            >
                                Tambah Data
                            </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[525px]">
                            <DialogHeader>
                                <DialogTitle className="capitalize">
                                    Tambah data kegiatan
                                </DialogTitle>
                                <DialogDescription>
                                    Isi form berikut untuk menambahkan data
                                    baru.
                                </DialogDescription>
                            </DialogHeader>
                            <form onSubmit={handleCreate} className="space-y-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700">
                                        Nama Kegiatan
                                    </label>
                                    <Input
                                        value={createData.nama_kegiatan}
                                        onChange={(e) =>
                                            setCreateData(
                                                "nama_kegiatan",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh: Karang Taruna"
                                    />
                                    {createErrors.nama_kegiatan && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.nama_kegiatan}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700">
                                        Lokasi Kegiatan
                                    </label>
                                    <Input
                                        value={createData.lokasi_kegiatan}
                                        onChange={(e) =>
                                            setCreateData(
                                                "lokasi_kegiatan",
                                                e.target.value
                                            )
                                        }
                                        placeholder="contoh: lapangan, balai desa, dll"
                                    />
                                    {createErrors.lokasi_kegiatan && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.lokasi_kegiatan}
                                        </p>
                                    )}
                                </div>

                                <div className="flex flex-col">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Tanggal Kegiatan
                                    </label>
                                    <Popover>
                                        <PopoverTrigger asChild>
                                            <Button
                                                variant="outline"
                                                className="w-full pl-3 text-left font-normal"
                                            >
                                                {createData.tanggal_kegiatan ? (
                                                    format(
                                                        parse(
                                                            createData.tanggal_kegiatan,
                                                            "yyyy-MM-dd",
                                                            new Date()
                                                        ),
                                                        "PPP",
                                                        { locale: id }
                                                    )
                                                ) : (
                                                    <span className="text-gray-700">
                                                        Pilih tanggal
                                                    </span>
                                                )}
                                                <CalendarIcon className="ml-auto h-4 w-4 opacity-50" />
                                            </Button>
                                        </PopoverTrigger>
                                        <PopoverContent
                                            className="w-auto p-0"
                                            align="start"
                                        >
                                            <Calendar
                                                mode="single"
                                                locale={id}
                                                selected={
                                                    createData.tanggal_kegiatan
                                                        ? parse(
                                                              createData.tanggal_kegiatan,
                                                              "yyyy-MM-dd",
                                                              new Date()
                                                          )
                                                        : null
                                                }
                                                onSelect={(date) =>
                                                    setCreateData(
                                                        "tanggal_kegiatan",
                                                        format(
                                                            date,
                                                            "yyyy-MM-dd"
                                                        )
                                                    )
                                                }
                                                className="rounded-md border shadow-sm"
                                                captionLayout="dropdown"
                                                initialFocus
                                            />
                                        </PopoverContent>
                                    </Popover>
                                    <p className="mt-1 text-sm text-gray-500">
                                        Pilih tanggal pelaksanaan kegiatan
                                    </p>
                                    {createErrors.tanggal_kegiatan && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.tanggal_kegiatan}
                                        </p>
                                    )}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700">
                                        Keterangan kegiatan (Opsional)
                                    </label>
                                    <Input
                                        value={createData.keterangan}
                                        onChange={(e) =>
                                            setCreateData(
                                                "keterangan",
                                                e.target.value
                                            )
                                        }
                                        placeholder="Keterangan kegiatan"
                                    />
                                    {createErrors.keterangan && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.keterangan}
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
                                    value={editFormData.nama_kegiatan}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "nama_kegiatan",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: Karang Taruna"
                                />
                                {updateErrors.nama_kegiatan && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.nama_kegiatan}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Lokasi Kegiatan
                                </label>
                                <Input
                                    value={editFormData.lokasi_kegiatan}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "lokasi_kegiatan",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: lapangan, balai desa, dll"
                                />
                                {updateErrors.lokasi_kegiatan && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.lokasi_kegiatan}
                                    </p>
                                )}
                            </div>

                            <div className="flex flex-col">
                                <label className="block text-sm font-medium text-gray-700">
                                    Tanggal Kegiatan
                                </label>
                                <Popover>
                                    <PopoverTrigger asChild>
                                        <Button
                                            variant="outline"
                                            className="w-full pl-3 text-left font-normal"
                                        >
                                            {editFormData.tanggal_kegiatan ? (
                                                format(
                                                    parse(
                                                        editFormData.tanggal_kegiatan,
                                                        "yyyy-MM-dd",
                                                        new Date()
                                                    ),
                                                    "PPP",
                                                    { locale: id }
                                                )
                                            ) : (
                                                <span className="text-gray-700">
                                                    Pilih tanggal
                                                </span>
                                            )}
                                            <CalendarIcon className="ml-auto h-4 w-4 opacity-50" />
                                        </Button>
                                    </PopoverTrigger>
                                    <PopoverContent
                                        className="w-auto p-0"
                                        align="start"
                                    >
                                        <Calendar
                                            mode="single"
                                            locale={id}
                                            selected={
                                                editFormData.tanggal_kegiatan
                                                    ? parse(
                                                          editFormData.tanggal_kegiatan,
                                                          "yyyy-MM-dd",
                                                          new Date()
                                                      )
                                                    : null
                                            }
                                            onSelect={(date) =>
                                                setEditFormData(
                                                    "tanggal_kegiatan",
                                                    format(date, "yyyy-MM-dd")
                                                )
                                            }
                                            className="rounded-md border shadow-sm"
                                            captionLayout="dropdown"
                                            initialFocus
                                        />
                                    </PopoverContent>
                                </Popover>
                                <p className="mt-1 text-sm text-gray-500">
                                    Pilih tanggal pelaksanaan kegiatan
                                </p>
                                {updateErrors.tanggal_kegiatan && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.tanggal_kegiatan}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Keterangan kegiatan (Opsional)
                                </label>
                                <Input
                                    value={editFormData.keterangan}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "keterangan",
                                            e.target.value
                                        )
                                    }
                                    placeholder="Keterangan kegiatan"
                                />
                                {updateErrors.keterangan && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.keterangan}
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
