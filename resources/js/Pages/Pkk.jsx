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
} from "@/Components/ui/dialog";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/Components/ui/popover";
import { Calendar } from "@/Components/ui/calendar";
import { CalendarIcon, Plus } from "lucide-react";
import { Input } from "@/Components/ui/input";
import { Button } from "@/Components/ui/button";
import { Pencil, Trash2 } from "lucide-react";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import Swal from "sweetalert2";
import CheckDataWarning from "@/Components/CheckDataWarning";



export default function Pkk({ datas, kelompokKerjas }) {
    const [editData, setEditData] = useState(null);
    const [showEditModal, setShowEditModal] = useState(false);

    // Form for creating new data
    const {
        data: createData,
        setData: setCreateData,
        post,
        processing: creating,
        errors: createErrors,
        reset: resetCreate,
    } = useForm({
        nama_pkk: "",
        jabatan_pkk: "",
        kelompok_kerja: "",
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
        id_pkk: "",
        nama_pkk: "",
        jabatan_pkk: "",
        kelompok_kerja: "",
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
        columnHelper.accessor("nama_pkk", {
            header: "Nama Anggota",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jabatan_pkk", {
            header: "Jabatan",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("kelompok_kerja", {
            header: "Kelompok Kerja",
            cell: (info) => info.getValue() || "Pengurus Inti",
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
                                    id_pkk: row.original.id_pkk,
                                    nama_pkk: row.original.nama_pkk,
                                    jabatan_pkk: row.original.jabatan_pkk,
                                    kelompok_kerja: row.original.kelompok_kerja || "",
                                });
                            }}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <Button
                            variant="destructive"
                            size="icon"
                            onClick={(e) => {
                                Swal.fire({
                                    title: "yakin ingin menghapus ini ?",
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: "Ya",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        router.delete(
                                            route(
                                                "pkks.destroy",
                                                row.original.id_pkk
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
                                                        title: "Gagal dihapus",
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

    const handleRowClick = () => {};

    // Handle create form submission
    const handleCreate = (e) => {
        e.preventDefault();
        post(route("pkks.store"), {
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
        put(route("pkks.update", editFormData.id_pkk), {
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
        <AuthenticatedLayout headerName="Pkk">
            <Head title="Pkk" />
            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 capitalize">
                            Data pemberdayaan kesejahteraan keluarga
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola data pemberdayaan kesejahteraan
                            keluarga
                        </p>
                    </div>
                    <div className="flex gap-2">
                        <Button
                            variant="outline"
                            onClick={() => router.visit(route('kelompok-kerjas.index'))}
                        >
                            <Plus className="h-4 w-4 mr-2" />
                            Kelola Kelompok Kerja
                        </Button>

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
                                        Tambah data pkk
                                    </DialogTitle>
                                    <DialogDescription>
                                        Isi form berikut untuk menambahkan data
                                        baru. Untuk Pengurus Inti (Ketua, Wakil Ketua, Sekretaris, Bendahara) tidak perlu memilih Kelompok Kerja.
                                    </DialogDescription>
                                </DialogHeader>
                                <form
                                    onSubmit={handleCreate}
                                    className="space-y-4"
                                >
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Nama Anggota
                                        </label>
                                        <Input
                                            value={createData.nama_pkk}
                                            onChange={(e) =>
                                                setCreateData(
                                                    "nama_pkk",
                                                    e.target.value
                                                )
                                            }
                                            placeholder="contoh: Herlina, S.Pd"
                                        />
                                        {createErrors.nama_pkk && (
                                            <p className="mt-1 text-sm text-red-600">
                                                {createErrors.nama_pkk}
                                            </p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Jabatan
                                        </label>
                                        <Input
                                            value={createData.jabatan_pkk}
                                            onChange={(e) =>
                                                setCreateData(
                                                    "jabatan_pkk",
                                                    e.target.value
                                                )
                                            }
                                            placeholder="contoh: Ketua, Wakil Ketua, Sekretaris, Bendahara, Ketua Pokja, Wakil Pokja, Anggota"
                                        />
                                        {createErrors.jabatan_pkk && (
                                            <p className="mt-1 text-sm text-red-600">
                                                {createErrors.jabatan_pkk}
                                            </p>
                                        )}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Kelompok Kerja 
                                        </label>
                                        <Select
                                            value={createData.kelompok_kerja}
                                            onValueChange={(value) =>
                                                setCreateData(
                                                    "kelompok_kerja",
                                                    value
                                                )
                                            }
                                        >
                                            <SelectTrigger>
                                                <SelectValue placeholder="Pilih kelompok kerja  " />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value="pengurus inti">
                                                    Pengurus Inti (Tidak ada Pokja)
                                                </SelectItem>
                                                {kelompokKerjas && kelompokKerjas.map((pokja) => (
                                                    <SelectItem
                                                        key={pokja.id_kelompok_kerja}
                                                        value={pokja.nama_kelompok_kerja}
                                                    >
                                                        {pokja.nama_kelompok_kerja}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <p className="text-xs mt-2 text-gray-600">* anda mungkin harus menambahkan kelompok kerja terlebih dahulu <a href="/kelompok-kerjas" className="text-blue-500">disini</a></p>
                                        {createErrors.kelompok_kerja && (
                                            <p className="mt-1 text-sm text-red-600">
                                                {createErrors.kelompok_kerja}
                                            </p>
                                        )}
                                    </div>

                                    <DialogFooter >
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
                                            disabled={creating}
                                        >
                                            {creating
                                                ? "Menyimpan..."
                                                : "Simpan"}
                                        </Button>
                                    </DialogFooter>
                                </form>
                            </DialogContent>
                        </Dialog>
                    </div>
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
                                Edit data PKK
                            </DialogTitle>
                            <DialogDescription>
                                Isi form berikut untuk mengubah data PKK. Untuk Pengurus Inti tidak perlu memilih Kelompok Kerja.
                            </DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleUpdate} className="space-y-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Nama Anggota
                                </label>
                                <Input
                                    value={editFormData.nama_pkk}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "nama_pkk",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: Herlina, S.Pd"
                                />
                                {updateErrors.nama_pkk && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.nama_pkk}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Jabatan
                                </label>
                                <Input
                                    value={editFormData.jabatan_pkk}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "jabatan_pkk",
                                            e.target.value
                                        )
                                    }
                                    placeholder="contoh: Ketua, Wakil Ketua, Sekretaris, Bendahara, dll"
                                />
                                {updateErrors.jabatan_pkk && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.jabatan_pkk}
                                    </p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Kelompok Kerja 
                                </label>
                                <Select
                                    value={editFormData.kelompok_kerja}
                                    onValueChange={(value) =>
                                        setEditFormData("kelompok_kerja", value)
                                    }
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder="Pilih kelompok kerja (Opsional)" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="pengurus inti">
                                            Pengurus Inti (Tidak ada Pokja)
                                        </SelectItem>
                                        {kelompokKerjas && kelompokKerjas.map((pokja) => (
                                            <SelectItem
                                                key={pokja.id_kelompok_kerja}
                                                value={pokja.nama_kelompok_kerja}
                                            >
                                                {pokja.nama_kelompok_kerja}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                {updateErrors.kelompok_kerja && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.kelompok_kerja}
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

            <CheckDataWarning />
        </AuthenticatedLayout>
    );
}