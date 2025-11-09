import React, {useState, useEffect} from "react";
import {
    Head,
    router,
    usePage,
    useForm as useFormInertia,
} from "@inertiajs/react";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog";


import { GenericTable } from "@/Components/GenericTable";
import { createColumnHelper } from "@tanstack/react-table";
import { Pencil, Trash2, Eye } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import Swal from "sweetalert2";

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
const DetailLaporanModal = ({ datas, onClose, onOpen }) => {
     const [open, setOpen] = useState(true);
    const [showEditModal, setShowEditModal] = useState(false);
    const { data, setData, put, processing, errors, reset } = useFormInertia({
        id_detail_rekap: "",
        id_rt: "",
        kelompok_umur: "",
        jumlah_laki_laki_awal: 0,
        jumlah_perempuan_awal: 0,
        jumlah_laki_laki_akhir: 0,
        jumlah_perempuan_akhir: 0,
        jumlah_laki_laki_pindah: 0,
        jumlah_perempuan_pindah: 0,
        jumlah_laki_laki_datang: 0,
        jumlah_perempuan_datang: 0,
        jumlah_kk:0
    });
    if (!datas || datas.length === 0) {
        return (
            <Dialog open={onOpen} onOpenChange={onClose}>
                <DialogContent className="max-w-6xl max-h-[90vh] overflow-y-auto">
                    <DialogHeader>
                        <DialogTitle>Detail Laporan RT</DialogTitle>
                        <DialogDescription>
                            Detail informasi laporan penduduk RT
                        </DialogDescription>
                    </DialogHeader>
                    <div className="p-8 text-center">
                        <p className="text-gray-500">Tidak ada data detail laporan</p>
                    </div>
                </DialogContent>
            </Dialog>
        );
    }
    // console.log(datas)
    const handleEditButton = (row) => {
        reset();
        setData(row);
        setShowEditModal(true);
        // setOpen(false);
        // setOpen(false);
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log("data yang akan dikirim : \n", data)
        put(route("detailLaporan.update", data.id_detail_rekap), {
            onSuccess: () => {
                reset();
                Toast.fire({
                    icon: "success",
                    title: "Berhasil diubah",
                    // text: ``
                });
                if (open) {
                    setOpen(false);
                    onClose();
                }
            },
            onError: (e) => {
               console.error(e);
            }
        });
    };
    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("kelompok_umur", {
            header: "Kelompok Umur",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_kk", {
            header: "Jumlah KK",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_laki_laki_awal", {
            header: "Laki-laki awal",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_perempuan_awal", {
            header: "perempuan awal",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_laki_laki_akhir", {
            header: "laki akhir",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_perempuan_akhir", {
            header: "perempuan akhir",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_laki_laki_datang", {
            header: "laki-laki datang",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_perempuan_datang", {
            header: "perempuan datang",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_laki_laki_pindah", {
            header: "Laki-laki Pindah",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("jumlah_perempuan_pindah", {
            header: "Perempuan Pindah",
            cell: (info) => info.getValue(),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                // console.log("row", row.original);
                // reset();
                // setData(row.original);
                // console.log('data', data)
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            className="bg-gray-200"
                            size="icon"
                            onClick={() => handleEditButton(row.original)}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <AlertDialog>
                            <AlertDialogTrigger>
                                <Button variant="destructive" size="icon">
                                    <Trash2 className="h-4 w-4" />
                                </Button>
                            </AlertDialogTrigger>
                            <AlertDialogContent>
                                <AlertDialogHeader>
                                    <AlertDialogTitle>
                                        yakin ingin menghapus ini ?
                                    </AlertDialogTitle>
                                    <AlertDialogDescription>
                                        Tindakan ini tidak dapat dibatalkan.
                                        Tindakan ini akan menghapus data Anda
                                        dari server kami.
                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel>Batal</AlertDialogCancel>
                                    <AlertDialogAction
                                        onClick={() => {
                                            // console.log(
                                            //     row.original.id_detail_rekap
                                            // );
                                            router.delete(
                                                route(
                                                    "detailLaporan.destroy",
                                                    row.original.id_detail_rekap
                                                ),
                                                {
                                                    onSuccess: () => {
                                                        setOpen(false);
                                                        onClose();
                                                        Toast.fire({
                                                            icon: "success",
                                                            title: "Berhasil dihapus",
                                                        });
                                                    },
                                                    onError: (e) => {
                                                        setOpen(false);
                                                        onClose();
                                                        Toast.fire({
                                                            icon: "error",
                                                            title: "Gagal menghapus",
                                                            text: "silahkan coba lagi nanti",
                                                        });
                                                    },
                                                }
                                            );
                                        }}
                                    >
                                        lanjut
                                    </AlertDialogAction>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>
                    </div>
                );
            },
        }),
    ];
    // Group data by kelompok_umur
    const groupedData = datas.reduce((acc, item) => {
        if (!acc[item.kelompok_umur]) {
            acc[item.kelompok_umur] = [];
        }
        acc[item.kelompok_umur].push(item);
        return acc;
    }, {});

    // Calculate totals
    const calculateTotals = (data) => {
        return data.reduce(
            (totals, item) => {
                totals.jumlah_kk += item.jumlah_kk || 0;
                totals.jumlah_laki_laki_awal += item.jumlah_laki_laki_awal || 0;
                totals.jumlah_perempuan_awal += item.jumlah_perempuan_awal || 0;
                totals.jumlah_laki_laki_akhir += item.jumlah_laki_laki_akhir || 0;
                totals.jumlah_perempuan_akhir += item.jumlah_perempuan_akhir || 0;
                totals.jumlah_laki_laki_pindah += item.jumlah_laki_laki_pindah || 0;
                totals.jumlah_perempuan_pindah += item.jumlah_perempuan_pindah || 0;
                totals.jumlah_laki_laki_datang += item.jumlah_laki_laki_datang || 0;
                totals.jumlah_perempuan_datang += item.jumlah_perempuan_datang || 0;
                return totals;
            },
            {
                jumlah_kk: 0,
                jumlah_laki_laki_awal: 0,
                jumlah_perempuan_awal: 0,
                jumlah_laki_laki_akhir: 0,
                jumlah_perempuan_akhir: 0,
                jumlah_laki_laki_pindah: 0,
                jumlah_perempuan_pindah: 0,
                jumlah_laki_laki_datang: 0,
                jumlah_perempuan_datang: 0,
            }
        );
    };

    const grandTotals = calculateTotals(datas);

    return (
        <>
        <Dialog  open={open}
                onOpenChange={(isOpen) => {
                    if (!isOpen) {
                        setOpen(false);
                        onClose();
                    }
                }}>
            <DialogContent className="md:max-w-4xl max-w-2xl max-h-[90vh] overflow-y-auto">
                <DialogHeader className="flex flex-row items-center justify-between">
                    <div>
                        <DialogTitle>Detail Laporan RT</DialogTitle>
                        <DialogDescription>
                            Detail informasi laporan penduduk RT berdasarkan kelompok umur
                        </DialogDescription>
                    </div>
                    
                </DialogHeader>

                <div className="space-y-6">
                    {/* Summary Cards */}
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div className="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <h3 className="text-sm font-medium text-blue-800">Total KK</h3>
                            <p className="text-2xl font-bold text-blue-900">{grandTotals.jumlah_kk}</p>
                        </div>
                        <div className="bg-green-50 p-4 rounded-lg border border-green-200">
                            <h3 className="text-sm font-medium text-green-800">Total Awal</h3>
                            <p className="text-2xl font-bold text-green-900">
                                {grandTotals.jumlah_laki_laki_awal + grandTotals.jumlah_perempuan_awal}
                            </p>
                        </div>
                        <div className="bg-purple-50 p-4 rounded-lg border border-purple-200">
                            <h3 className="text-sm font-medium text-purple-800">Total Akhir</h3>
                            <p className="text-2xl font-bold text-purple-900">
                                {grandTotals.jumlah_laki_laki_akhir + grandTotals.jumlah_perempuan_akhir}
                            </p>
                        </div>
                        <div className="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <h3 className="text-sm font-medium text-yellow-800">Mutasi</h3>
                            <p className="text-2xl font-bold text-yellow-900">
                                {(grandTotals.jumlah_laki_laki_datang + grandTotals.jumlah_perempuan_datang) - 
                                 (grandTotals.jumlah_laki_laki_pindah + grandTotals.jumlah_perempuan_pindah)}
                            </p>
                        </div>
                    </div>

                    <div className="mt-4 overflow-x-auto w-full">
                        <GenericTable
                            data={datas}
                            columns={columns}
                            pagination={false}
                            pageSize={15}
                        />
                    </div>

                    {/* Grand Total */}
                    <div className="border rounded-lg overflow-hidden bg-blue-50">
                        <div className="bg-blue-100 px-4 py-3 border-b">
                            <h3 className="text-lg font-bold text-blue-900">
                                Total Keseluruhan RT
                            </h3>
                        </div>
                        
                        <div className="overflow-x-auto">
                            <table className="min-w-full">
                                <thead className="bg-blue-100">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider border-r">
                                            Kategori
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-blue-800 uppercase tracking-wider border-r">
                                            Total KK
                                        </th>
                                        <th colSpan="2" className="px-6 py-3 text-center text-xs font-medium text-blue-800 uppercase tracking-wider border-r">
                                            Awal Bulan
                                        </th>
                                        <th colSpan="2" className="px-6 py-3 text-center text-xs font-medium text-blue-800 uppercase tracking-wider border-r">
                                            Mutasi Keluar
                                        </th>
                                        <th colSpan="2" className="px-6 py-3 text-center text-xs font-medium text-blue-800 uppercase tracking-wider border-r">
                                            Mutasi Masuk
                                        </th>
                                        <th colSpan="2" className="px-6 py-3 text-center text-xs font-medium text-blue-800 uppercase tracking-wider">
                                            Akhir Bulan
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">L</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">P</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">L</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">P</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">L</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">P</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase border-r">L</th>
                                        <th className="px-3 py-2 text-xs font-medium text-blue-800 uppercase">P</th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white">
                                    <tr className="text-lg font-bold text-blue-900">
                                        <td className="px-6 py-6 whitespace-nowrap border-r">
                                            GRAND TOTAL
                                        </td>
                                        <td className="px-6 py-6 whitespace-nowrap text-center border-r">
                                            {grandTotals.jumlah_kk}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center border-r">
                                            {grandTotals.jumlah_laki_laki_awal}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center border-r">
                                            {grandTotals.jumlah_perempuan_awal}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center text-red-600 border-r">
                                            -{grandTotals.jumlah_laki_laki_pindah}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center text-red-600 border-r">
                                            -{grandTotals.jumlah_perempuan_pindah}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center text-green-600 border-r">
                                            +{grandTotals.jumlah_laki_laki_datang}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center text-green-600 border-r">
                                            +{grandTotals.jumlah_perempuan_datang}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center border-r">
                                            {grandTotals.jumlah_laki_laki_akhir}
                                        </td>
                                        <td className="px-3 py-6 whitespace-nowrap text-center">
                                            {grandTotals.jumlah_perempuan_akhir}
                                        </td>
                                    </tr>
                                    <tr className="bg-gray-50 font-medium text-gray-700">
                                        <td className="px-6 py-4 whitespace-nowrap border-r">
                                            Total Penduduk
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-center border-r">
                                            -
                                        </td>
                                        <td colSpan="2" className="px-6 py-4 whitespace-nowrap text-center border-r">
                                            <span className="text-lg font-bold">
                                                {grandTotals.jumlah_laki_laki_awal + grandTotals.jumlah_perempuan_awal} Jiwa
                                            </span>
                                        </td>
                                        <td colSpan="2" className="px-6 py-4 whitespace-nowrap text-center border-r">
                                            <span className="text-lg font-bold text-red-600">
                                                -{grandTotals.jumlah_laki_laki_pindah + grandTotals.jumlah_perempuan_pindah} Jiwa
                                            </span>
                                        </td>
                                        <td colSpan="2" className="px-6 py-4 whitespace-nowrap text-center border-r">
                                            <span className="text-lg font-bold text-green-600">
                                                +{grandTotals.jumlah_laki_laki_datang + grandTotals.jumlah_perempuan_datang} Jiwa
                                            </span>
                                        </td>
                                        <td colSpan="2" className="px-6 py-4 whitespace-nowrap text-center">
                                            <span className="text-lg font-bold">
                                                {grandTotals.jumlah_laki_laki_akhir + grandTotals.jumlah_perempuan_akhir} Jiwa
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div className="flex justify-end">
                        <Button onClick={onClose}>
                            Tutup
                        </Button>
                    </div>
                </div>
                
            </DialogContent>
        </Dialog>

        {showEditModal && (
            <Dialog
                open={showEditModal}
                onOpenChange={() => {
                    setShowEditModal(false)
                                        
                }}
            >
                <DialogContent className="overflow-y-auto max-h-[85%] max-w-2xl">
                    <DialogHeader>
                        <DialogTitle>
                            Ubah Rincian Laporan Penduduk
                        </DialogTitle>
                    </DialogHeader>
                    <p>
                        Kelompok umur : <span>{data.kelompok_umur}</span>{" "}
                        tahun
                    </p>

                    <form
                        className="space-y-1 flex flex-col gap-2 "
                        onSubmit={(e) => {
                            handleSubmit(e);
                        }}
                    >
                        <div className="">
                            <div className="border rounded-lg p-4 space-y-4">
                                <h3 className="font-medium">
                                    Jumlah Penduduk Awal
                                </h3>
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_laki_laki_awal">
                                            Laki-laki
                                        </Label>
                                        <Input
                                            id="jumlah_laki_laki_awal"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_laki_laki_awal
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_laki_laki_awal",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_perempuan_awal">
                                            Perempuan
                                        </Label>
                                        <Input
                                            id="jumlah_perempuan_awal"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_perempuan_awal
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_perempuan_awal",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="border rounded-lg p-4 space-y-4">
                                <h3 className="font-medium">
                                    Jumlah Penduduk Akhir
                                </h3>
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_laki_laki_akhir">
                                            Laki-laki
                                        </Label>
                                        <Input
                                            id="jumlah_laki_laki_akhir"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_laki_laki_akhir
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_laki_laki_akhir",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_perempuan_akhir">
                                            Perempuan
                                        </Label>
                                        <Input
                                            id="jumlah_perempuan_akhir"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_perempuan_akhir
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_perempuan_akhir",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div className="border rounded-lg p-4 space-y-4">
                                <h3 className="font-medium">
                                    Jumlah Penduduk Pindah
                                </h3>
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_laki_laki_pindah">
                                            Laki-laki
                                        </Label>
                                        <Input
                                            id="jumlah_laki_laki_pindah"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_laki_laki_pindah
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_laki_laki_pindah",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_perempuan_pindah">
                                            Perempuan
                                        </Label>
                                        <Input
                                            id="jumlah_perempuan_pindah"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_perempuan_pindah
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_perempuan_pindah",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="border rounded-lg p-4 space-y-4">
                                <h3 className="font-medium">
                                    Jumlah Penduduk Datang
                                </h3>
                                <div className="grid grid-cols-2 gap-4">
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_laki_laki_datang">
                                            Laki-laki
                                        </Label>
                                        <Input
                                            id="jumlah_laki_laki_datang"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_laki_laki_datang
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_laki_laki_datang",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="grid gap-2">
                                        <Label htmlFor="jumlah_perempuan_datang">
                                            Perempuan
                                        </Label>
                                        <Input
                                            id="jumlah_perempuan_datang"
                                            type="number"
                                            min="0"
                                            value={
                                                data.jumlah_perempuan_datang
                                            }
                                            onChange={(e) =>
                                                setData(
                                                    "jumlah_perempuan_datang",
                                                    parseInt(
                                                        e.target.value
                                                    ) || 0
                                                )
                                            }
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="border rounded-lg p-4 space-y-4">
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_kk">Jumlah KK</Label>
                                <Input
                                    id="jumlah_kk"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_kk}
                                    onChange={(e) =>
                                        setData("jumlah_kk", e.target.value)
                                    }
                                />
                            </div>
                        </div>
                        <div className="flex justify-end gap-2 pt-4">
                            <Button
                                type="button"
                                variant="outline"
                                id="closeDialog"
                                // onClick={() => handleCancel()}
                            >
                                Batal
                            </Button>
                            <Button type="submit" disabled={processing}>
                                {processing ? "Menyimpan..." : "Simpan"}
                            </Button>
                        </div>
                    </form>
                </DialogContent>
            </Dialog>
        )}

        </>

    );
};

export default DetailLaporanModal;