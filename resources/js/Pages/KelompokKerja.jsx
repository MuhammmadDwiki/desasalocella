import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm } from "@inertiajs/react";
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
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Pencil, Trash2, AlertCircle, Users } from "lucide-react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import Swal from "sweetalert2";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { FaArrowLeft } from "react-icons/fa6";


export default function KelompokKerja({ kelompokKerjas }) {
    const [showEditModal, setShowEditModal] = useState(false);
    const [showDeleteModal, setShowDeleteModal] = useState(false);
    const [selectedKelompok, setSelectedKelompok] = useState(null);

    // Form for creating new kelompok kerja
    const {
        data: createData,
        setData: setCreateData,
        post,
        processing: creating,
        errors: createErrors,
        reset: resetCreate,
    } = useForm({
        nama_kelompok_kerja: "",
    });

    // Form for editing kelompok kerja
    const {
        data: editData,
        setData: setEditData,
        put,
        processing: updating,
        errors: updateErrors,
    } = useForm({
        id_kelompok_kerja: "",
        nama_kelompok_kerja: "",
    });

    // Form for deleting with transfer
    const {
        data: deleteData,
        setData: setDeleteData,
        post: postDelete,
        processing: deleting,
        errors: deleteErrors,
    } = useForm({
        kelompok_kerja_baru: "",
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
        columnHelper.accessor("nama_kelompok_kerja", {
            header: "Nama Kelompok Kerja",
            cell: (info) => (
                <div className="flex items-center gap-2">
                    <span className="font-medium">{info.getValue()}</span>
                </div>
            ),
        }),
        columnHelper.accessor("pkks_count", {
            header: "Jumlah Anggota",
            cell: (info) => (
                <div className="flex items-center gap-2">
                    <Users className="h-4 w-4 text-gray-500" />
                    <span>{info.getValue() || 0} orang</span>
                </div>
            ),
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
                                setEditData({
                                    id_kelompok_kerja: row.original.id_kelompok_kerja,
                                    nama_kelompok_kerja: row.original.nama_kelompok_kerja,
                                });
                            }}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <Button
                            variant="destructive"
                            size="icon"
                            onClick={() => {
                                setSelectedKelompok(row.original);
                                
                                // Jika tidak ada anggota, langsung hapus
                                if (!row.original.pkks_count || row.original.pkks_count === 0) {
                                    Swal.fire({
                                        title: "Yakin ingin menghapus?",
                                        text: `Kelompok kerja "${row.original.nama_kelompok_kerja}" akan dihapus`,
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "Ya, Hapus",
                                        cancelButtonText: "Batal",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            router.delete(
                                                route("kelompok-kerjas.destroy", row.original.id_kelompok_kerja),
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
                                } else {
                                    // Jika ada anggota, tampilkan modal untuk transfer
                                    setShowDeleteModal(true);
                                    setDeleteData({ kelompok_kerja_baru: "" });
                                }
                            }}
                        >
                            <Trash2 className="h-4 w-4" />
                        </Button>
                    </div>
                );
            },
        }),
    ];

    const handleCreate = (e) => {
        e.preventDefault();
        post(route("kelompok-kerjas.store"), {
            onSuccess: () => {
                resetCreate();
                Toast.fire({
                    icon: "success",
                    title: "Kelompok kerja berhasil ditambahkan",
                });
                document.getElementById("closeCreateDialog").click();
            },
            onError: () => {
                Toast.fire({
                    icon: "error",
                    title: "Kelompok kerja gagal ditambahkan",
                });
            },
        });
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        put(route("kelompok-kerjas.update", editData.id_kelompok_kerja), {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Kelompok kerja berhasil diupdate",
                });
                setShowEditModal(false);
            },
            onError: () => {
                Toast.fire({
                    icon: "error",
                    title: "Kelompok kerja gagal diupdate",
                });
            },
        });
    };

    const handleDeleteWithTransfer = (e) => {
        e.preventDefault();
        postDelete(
            route("kelompok-kerjas.delete-with-transfer", selectedKelompok.id_kelompok_kerja),
            {
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Kelompok kerja berhasil dihapus",
                    });
                    setShowDeleteModal(false);
                },
                onError: () => {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal menghapus kelompok kerja",
                    });
                },
            }
        );
    };

    return (
        <AuthenticatedLayout headerName="Kelompok Kerja">
            <Head title="Kelompok Kerja" />
            <div className="container mx-auto py-8">
                <div>
                    <span className="flex items-center gap-2 mb-4">
                        <FaArrowLeft />
                        <a href="/pemberdayaan-kesejahteraan-keluarga">kembali</a>
                    </span>
                </div>
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Kelola Kelompok Kerja PKK
                        </h1>
                        <p className="text-gray-600">
                            Kelola kelompok kerja (Pokja) untuk PKK
                        </p>
                    </div>
                    <Dialog>
                        <DialogTrigger asChild>
                            <Button variant="default" onClick={() => resetCreate()}>
                                Tambah Kelompok Kerja
                            </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[425px]">
                            <DialogHeader>
                                <DialogTitle>Tambah Kelompok Kerja</DialogTitle>
                                <DialogDescription>
                                    Tambahkan kelompok kerja baru untuk PKK
                                </DialogDescription>
                            </DialogHeader>
                            <form onSubmit={handleCreate} className="space-y-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700">
                                        Nama Kelompok Kerja
                                    </label>
                                    <Input
                                        value={createData.nama_kelompok_kerja}
                                        onChange={(e) =>
                                            setCreateData("nama_kelompok_kerja", e.target.value)
                                        }
                                        placeholder="contoh: Pokja 1, Pokja 2, dll"
                                    />
                                    {createErrors.nama_kelompok_kerja && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.nama_kelompok_kerja}
                                        </p>
                                    )}
                                </div>
                                <DialogFooter>
                                    <DialogClose asChild>
                                        <Button
                                            type="button"
                                            variant="outline"
                                            id="closeCreateDialog"
                                        >
                                            Batal
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

                <Alert className="mb-6">
                    <AlertCircle className="h-4 w-4" />
                    <AlertDescription>
                        <strong>Catatan:</strong> Saat mengubah nama kelompok kerja, semua data
                        PKK yang terkait akan otomatis diperbarui. Kelompok kerja yang masih
                        memiliki anggota tidak dapat dihapus kecuali anggota dipindahkan terlebih
                        dahulu.
                    </AlertDescription>
                </Alert>

                <GenericTable
                    data={kelompokKerjas}
                    columns={columns}
                    onRowClick={() => {}}
                    pageSize={10}
                />
            </div>

            {/* Edit Modal */}
            {showEditModal && (
                <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
                    <DialogContent className="sm:max-w-[425px]">
                        <DialogHeader>
                            <DialogTitle>Edit Kelompok Kerja</DialogTitle>
                            <DialogDescription>
                                Ubah nama kelompok kerja. Semua data PKK terkait akan otomatis
                                diperbarui.
                            </DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleUpdate} className="space-y-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Nama Kelompok Kerja
                                </label>
                                <Input
                                    value={editData.nama_kelompok_kerja}
                                    onChange={(e) =>
                                        setEditData("nama_kelompok_kerja", e.target.value)
                                    }
                                    placeholder="contoh: Pokja 1, Pokja 2, dll"
                                />
                                {updateErrors.nama_kelompok_kerja && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.nama_kelompok_kerja}
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
                                    {updating ? "Mengupdate..." : "Simpan"}
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            )}

            {/* Delete with Transfer Modal */}
            {showDeleteModal && selectedKelompok && (
                <Dialog open={showDeleteModal} onOpenChange={setShowDeleteModal}>
                    <DialogContent className="sm:max-w-[525px]">
                        <DialogHeader>
                            <DialogTitle>Hapus Kelompok Kerja</DialogTitle>
                            <DialogDescription>
                                Kelompok kerja "{selectedKelompok.nama_kelompok_kerja}" memiliki{" "}
                                {selectedKelompok.pkks_count} anggota. Pilih kelompok kerja tujuan
                                untuk memindahkan anggota tersebut, atau kosongkan untuk menjadikan
                                mereka Pengurus Inti.
                            </DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleDeleteWithTransfer} className="space-y-4">
                            <Alert variant="destructive">
                                <AlertCircle className="h-4 w-4" />
                                <AlertDescription>
                                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan.
                                    Semua {selectedKelompok.pkks_count} anggota akan dipindahkan.
                                </AlertDescription>
                            </Alert>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Pindahkan anggota ke:
                                </label>
                                <Select
                                    value={deleteData.kelompok_kerja_baru}
                                    onValueChange={(value) =>
                                        setDeleteData("kelompok_kerja_baru", value)
                                    }
                                >
                                    <SelectTrigger>
                                        <SelectValue placeholder="Pilih kelompok kerja tujuan" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="pengurus inti">
                                            Pengurus Inti (Tidak ada Pokja)
                                        </SelectItem>
                                        {kelompokKerjas
                                            .filter(
                                                (k) =>
                                                    k.id_kelompok_kerja !==
                                                    selectedKelompok.id_kelompok_kerja
                                            )
                                            .map((pokja) => (
                                                <SelectItem
                                                    key={pokja.id_kelompok_kerja}
                                                    value={pokja.nama_kelompok_kerja}
                                                >
                                                    {pokja.nama_kelompok_kerja}
                                                </SelectItem>
                                            ))}
                                    </SelectContent>
                                </Select>
                                {deleteErrors.kelompok_kerja_baru && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {deleteErrors.kelompok_kerja_baru}
                                    </p>
                                )}
                            </div>

                            <DialogFooter>
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => setShowDeleteModal(false)}
                                >
                                    Batal
                                </Button>
                                <Button type="submit" variant="destructive" disabled={deleting}>
                                    {deleting ? "Menghapus..." : "Hapus & Pindahkan"}
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            )}
        </AuthenticatedLayout>
    );
}