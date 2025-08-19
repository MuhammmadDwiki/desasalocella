import { useState, useEffect } from "react";
import {
    Head,
    router,
    usePage,
    useForm as useFormInertia,
} from "@inertiajs/react";
import {
    Dialog,
    DialogContent,
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
import { DialogDescription } from "@radix-ui/react-dialog";
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
export default function DetailLaporanBulanan({ datas, onClose }) {
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
    // console.log("datas: ", datas);
    const handleEditButton = (row) => {
        reset();
        setData(row);
        setShowEditModal(true);
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        // console.log("data yang akan dikirim : \n", data)
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

    const calculateSummary = (data) => {
        const totals = data.reduce(
            (acc, item) => ({
                lakiAwal: acc.lakiAwal + item.jumlah_laki_laki_awal,
                perempuanAwal: acc.perempuanAwal + item.jumlah_perempuan_awal,
                lakiAkhir: acc.lakiAkhir + item.jumlah_laki_laki_akhir,
                perempuanAkhir:
                    acc.perempuanAkhir + item.jumlah_perempuan_akhir,
                lakiDatang: acc.lakiDatang + item.jumlah_laki_laki_datang,
                perempuanDatang:
                    acc.perempuanDatang + item.jumlah_perempuan_datang,
                lakiPindah: acc.lakiPindah + item.jumlah_laki_laki_pindah,
                perempuanPindah:
                    acc.perempuanPindah + item.jumlah_perempuan_pindah,
            }),
            {
                lakiAwal: 0,
                perempuanAwal: 0,
                lakiAkhir: 0,
                perempuanAkhir: 0,
                lakiDatang: 0,
                perempuanDatang: 0,
                lakiPindah: 0,
                perempuanPindah: 0,
            }
        );

        const totalPopulationAkhir = totals.lakiAkhir + totals.perempuanAkhir;
        const totalPopulationAwal = (totals.lakiAwal = totals.perempuanAwal);
        const totalPopulation = totalPopulationAkhir;
        const totalHouseholds = totalPopulation / 4; // Asumsi 1 household = 2 orang
        const newHouseholds = Math.max(
            0,
            totals.lakiDatang +
                totals.perempuanDatang -
                totals.lakiPindah -
                totals.perempuanPindah
        );

        return {
            totalPopulation: totalPopulation,
            totalDatang: totals.lakiDatang + totals.perempuanDatang,
            totalPindah: totals.lakiPindah + totals.perempuanPindah,
        };
    };
    // let summary = {};
    const summary = calculateSummary(datas);
    // console.log(summary);
    // useEffect(() => {
    // }, [datas]);
    // console.log(open);

    return (
        <>
            <Dialog
                open={open}
                onOpenChange={(isOpen) => {
                    if (!isOpen) {
                        setOpen(false);
                        onClose();
                    }
                }}
            >
                <DialogContent className="max-w-5xl max-h-[80vh] overflow-y-auto">
                    <DialogHeader>
                        <DialogTitle className="capitalize font-bold">
                            Detail Laporan Penduduk
                        </DialogTitle>
                        <DialogDescription className="text-gray-600">
                            Rincian Laporan Penduduk tiap RT
                        </DialogDescription>
                    </DialogHeader>

                    <div className="mt-4">
                        <GenericTable
                            data={datas}
                            columns={columns}
                            pagination={false}
                            pageSize={15}
                        />
                    </div>

                    <div className="flex flex-col w-full flex-wrap mt-4 pb-8 border-b">
                        <div>
                            <h2 className="text-md font-semibold mb-3">
                                Ringkasan Penduduk
                            </h2>
                        </div>
                        <div className="flex  items-center gap-5 justify-around">
                            <div className="bg-[#DEE791] py-4 px-8 rounded-md">
                                <p className="text-gray-700 capitalize">
                                    Total Penduduk
                                </p>
                                <p className="font-semibold">
                                    {summary.totalPopulation}
                                </p>
                            </div>
                            <div className="bg-[#A3DC9A] py-4 px-8 rounded-md">
                                <p className="text-gray-700 capitalize">
                                    Penduduk Datang
                                </p>
                                <p className="font-semibold">
                                    {summary.totalDatang}
                                </p>
                            </div>
                            <div className="bg-[#C0C9EE] py-4 px-8 rounded-md">
                                <p className="text-gray-700 capitalize">
                                    Penduduk Pindah
                                </p>
                                <p className="font-semibold">
                                    {summary.totalPindah}
                                </p>
                            </div>
                        </div>
                    </div>
                </DialogContent>
            </Dialog>
            {showEditModal && (
                <Dialog
                    open={showEditModal}
                    onOpenChange={() => setShowEditModal(false)}
                >
                    <DialogContent className="overflow-y-auto max-h-[80%] max-w-2xl">
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
}

// <div className="overflow-x-auto">
//                     <div className="overflow-y-auto mb-6">
//                         <table className="min-w-full divide-y divide-gray-200">
//                             <thead className="bg-gray-50">
//                                 <tr>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Kelompok Umur
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Laki-laki Awal
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Perempuan Awal
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Laki-laki Akhir
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Perempuan Akhir
//                                     </th>
//                                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Laki-laki Datang
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Perempuan Datang
//                                     </th>
//                                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Laki-laki Pindah
//                                     </th>
//                                     <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                         Perempuan Pindah
//                                     </th>
//                                 </tr>
//                             </thead>
//                             <tbody className="bg-white divide-y divide-gray-20">
//                                 {datas.map((detail, index) => (
//                                     <tr key={index}>
//                                         <td className="py-1 px-2  border">
//                                             <span className="rounded-full py-1 px-3 bg-blue-100 text-blue-800 ">
//                                                 {detail.kelompok_umur}

//                                             </span>
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_laki_laki_awal}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_perempuan_awal}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_laki_laki_akhir}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_perempuan_akhir}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_laki_laki_datang}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_perempuan_datang}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_laki_laki_pindah}
//                                         </td>
//                                         <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                             {detail.jumlah_perempuan_pindah}
//                                         </td>
//                                     </tr>
//                                 ))}
//                             </tbody>
//                         </table>
//                     </div>
// </div>
