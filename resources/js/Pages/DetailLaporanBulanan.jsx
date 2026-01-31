import React, { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm, usePage } from "@inertiajs/react";
import { GenericTable } from "@/Components/GenericTable";
import { createColumnHelper } from "@tanstack/react-table";
import { FaAngleLeft } from "react-icons/fa";
import CreateDetailLaporan from "@/Components/CreateDetailLaporan";
import { Pencil, Trash2, Eye, Plus } from "lucide-react";
import { Button } from "@/Components/ui/button";
import DetailLaporanModal from "@/Components/DetailLaporanModal";
import axios from "axios";
import Swal from "sweetalert2";
import { Badge } from "@/Components/ui/badge";
import {
    Tooltip,
    TooltipContent,
    TooltipTrigger,
    TooltipProvider,
} from "@/Components/ui/tooltip";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/Components/ui/popover"

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

const DetailLaporanBulanan = ({ id, datas, rtList, laporanInfo }) => {
    const { data, setData, post, processing, errors, reset } = useForm();
    const [modalData, setModalData] = useState([]);
    const [showDetailModal, setShowDetailModal] = useState(false);
    const [showCreateModal, setShowCreateModal] = useState(false);
    const { auth } = usePage().props;
    // const { notifications } = usePage().props;
    // console.log(notifications)
    const isModerator = auth.user.role === "moderator";
    const isSuperAdmin = auth.user.role === "super_admin";

    const canAccessRT = (rtId) => {
        return auth.user.role === "super_admin" || auth.user.id_rt === rtId;
    };
    // Filter data berdasarkan role user
    const filteredData =
        auth.user.role === "super_admin"
            ? datas
            : datas.filter((item) => item.id_rt === auth.user.id_rt);
    // console.log(filteredData);

    // console.log("Filtered data:", filteredData);

    // const Toast = Swal.mixin({
    //     toast: true,
    //     position: "top-end",
    //     showConfirmButton: false,
    //     timer: 3000,
    //     timerProgressBar: true,
    //     didOpen: (toast) => {
    //         toast.onmouseenter = Swal.stopTimer;
    //         toast.onmouseleave = Swal.resumeTimer;
    //     },
    // });

    const canEdit = (laporan) => {
        return (
            auth.user.role === "super_admin"
            // ||
            // (auth.user.role === "moderator" && laporan.id_rt === auth.user.id_rt)
        );
    };

    const canDelete = (laporan) => {
        return (
            auth.user.role === "super_admin"
            // ||
            // (auth.user.role === "moderator" && laporan.id_rt === auth.user.id_rt)
        );
    };

    const handleBack = () => {
        router.get(route("laporan.index"));
    };

    const handleDetailClick = async (row) => {
        try {
            const idRt = row?.id_rt;
            const idLaporan = id;
            const id_rekap_rt = row.id_rekap_rt;

            // return console.log(row.id_rekap_rt)
            const response = await axios.get(
                route("detail-laporan.by-rt", { id_rekap_rt })
            );
            console.log("response : ", response);

            setModalData(response.data);
            setShowDetailModal(true);
        } catch (error) {
            Toast.fire({
                icon: "error",
                title: "Gagal mengambil detail laporan",
            });
            console.error("Error fetching detail:", error);
        }
    };

    const handleDelete = (id_detail_rekap, namaRt) => {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: `Semua Detail laporan RT ${namaRt} akan dihapus permanent!`,
            icon: "warning",
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",

            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(
                    route("detail-laporan.destroy", id_detail_rekap),
                    {
                        onSuccess: () => {
                            Toast.fire({
                                icon: "success",
                                title: "Detail laporan berhasil dihapus",
                            });
                        },
                        onError: () => {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus detail laporan",
                            });
                        },
                    }
                );
            }
        });
    };

    const getRtName = (idRt) => {
        const rt = rtList?.find((rt) => rt.id_rt === idRt);
        return rt ? rt.nama_rt : `RT ${idRt}`;
    };

    const getMonthName = (monthNumber) => {
        const months = {
            "01": "Januari",
            "02": "Februari",
            "03": "Maret",
            "04": "April",
            "05": "Mei",
            "06": "Juni",
            "07": "Juli",
            "08": "Agustus",
            "09": "September",
            "10": "Oktober",
            "11": "November",
            "12": "Desember",
        };
        return months[monthNumber] || monthNumber;
    };

  
    const openRejectModal = async (idRekapRt) => {
        const { value: text, isConfirmed } = await Swal.fire({
            input: "textarea",
            inputLabel: "Pesan (opsional)",
            inputPlaceholder: "Type your message here...",
            inputAttributes: {
                "aria-label": "Type your message here",
            },
            showCancelButton: true,
        });

        if (!isConfirmed) return;
        const message = (text ?? "").trim() || null;

        console.log("reject : ", idRekapRt, message);
        router.post(
            route("rekapitulasi-rt.reject", { id_rekap_rt: idRekapRt }),
            { message }, 
            {
                onSuccess: () =>
                    Toast.fire({
                        icon: "success",
                        title: "Status berhasil ditolak",
                    }),
                onError: (e) => {
                    Toast.fire({ icon: "error", title: "Gagal menolak" });
                    console.error(e);
                },
            }
        );
    };

    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("id_rt", {
            header: "nomor Rt",
            cell: (info) => {
                const rt = rtList?.find((rt) => rt.id_rt === info.getValue());
                return rt ? `RT ${rt.nomor_rt}` : `RT ${info.getValue()}`;
            },
        }),
        columnHelper.accessor("nama_rt", {
            header: "Nama RT",
            cell: (info) => {
                const rt = rtList?.find(
                    (rt) => rt.id_rt === info.row.original.id_rt
                );
                return rt ? rt.nama_rt : "-";
            },
        }),
        columnHelper.accessor("jumlah_kk", {
            header: "Jumlah KK",
            cell: (info) => {
                const value = info.getValue() || 0;
                return (
                    <div className="text-center">
                        <span className="font-medium">{value}</span>
                        <span className="text-xs text-gray-500 ml-1">KK</span>
                    </div>
                );
            },
        }),
        columnHelper.accessor("jumlah_penduduk_akhir", {
            header: "Jumlah Akhir Penduduk",
            cell: (info) => {
                const value = info.getValue() || 0;
                return (
                    <div className="text-center">
                        <span className="font-medium">{value}</span>
                        <span className="text-xs text-gray-500 ml-1">
                            Orang
                        </span>
                    </div>
                );
            },
        }),
        columnHelper.accessor("status", {
            header: "Status",
            cell: (info) => {
                // const status = "draft";
                const status = info.getValue();

                return (
                    <Badge
                        variant='simple'
                        className={
                            status === "approved"
                                ? "bg-green-500"
                                : status === "rejected"
                                ? "bg-red-500"
                                : status === "pending"
                                ? "bg-yellow-500"
                                : "bg-gray-500"
                        }
                    >
                        {status.toUpperCase()}
                    </Badge>
                );
            },
        }),

        columnHelper.accessor("catatan_validasi", {
            header: "Keterangan",
            cell: (info) => {
                const text = info.getValue() || "-";
                const maxLen = 25;
                const isLong = text.length > maxLen;
                return (
                    // <TooltipProvider>
                    //     <Tooltip>
                    //         <TooltipTrigger >
                             
                    //             <span className="ml-1 text-blue-500 text-sm group-hover:underline">
                    //                 lihat
                    //             </span>
                               
                    //         </TooltipTrigger>
                    //         <TooltipContent>
                    //             <p>{text}</p>
                    //         </TooltipContent>
                    //     </Tooltip>
                    // </TooltipProvider>
                    <Popover>
                        <PopoverTrigger>
                            <span className="ml-1 text-blue-500 text-sm group-hover:underline">
                                   lihat
                            </span>
                        </PopoverTrigger>
                        <PopoverContent>
                            <p className="text-sm">{text}</p>
                        </PopoverContent>
                    </Popover>
                );
            },
        }),
        columnHelper.accessor("submitted_at", {
            header: "submitted at",
            cell: (info) => {
                // const status = "draft";
                const value = info.getValue() || "-";

                return (
                    <div className="text-center">
                        <span className="">{value}</span>
                    </div>
                );
            },
        }),

        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                const { status, id_rekap_rt, id_rt } = row.original;

                return (
                    <div className="flex space-x-1 items-center">
                  
                        <Button
                            size="sm"
                            variant="secondary"
                            className="bg-blue-600 hover:bg-blue-700"
                            // size="icon"
                            onClick={() => handleDetailClick(row.original)}
                        >
                            <Eye className="h-4 w-4 text-white" />
                        </Button>

                        {/* Moderator */}
                        {isModerator && status === "draft" && (
                            <Button
                                size="sm"
                                // className="bg-blue-600 hover:bg-blue-700"
                                variant="default"
                                onClick={() =>
                                    router.post(
                                        route("rekapitulasi-rt.submit", {
                                            id_rekap_rt,
                                        }),
                                        {},
                                        {
                                            onSuccess: () => {},
                                        }
                                    )
                                }
                            >
                                Kirim
                            </Button>
                        )}

                        {isModerator && status === "rejected" && (
                            <Button
                                size="sm"
                                className="bg-yellow-600 hover:bg-yellow-700"
                                onClick={() =>
                                    router.post(
                                        route("rekapitulasi-rt.submit", {
                                            id_rekap_rt,
                                        }),
                                        {},
                                        {
                                            onSuccess: () => {},
                                        }
                                    )
                                }
                            >
                                Kirim Ulang
                            </Button>
                        )}

                        {/* Super-admin */}
                        {isSuperAdmin && status === "pending" && (
                            <>
                                <Button
                                    size="sm"
                                    className="bg-green-600 hover:bg-green-700"
                                    onClick={() =>
                                        router.post(
                                            route("rekapitulasi-rt.validate", {
                                                id_rekap_rt,
                                            }),
                                            {
                                                action: "approve",
                                            }
                                        )
                                    }
                                >
                                    Approve
                                </Button>
                                <Button
                                    size="sm"
                                    className="bg-red-600 hover:bg-red-700"
                                    onClick={() => openRejectModal(id_rekap_rt)}
                                >
                                    Reject
                                </Button>
                            </>
                        )}
                    </div>
                );
            },
        }),
    ];

    const handleRowClick = (row) => {};

    return (
        <AuthenticatedLayout headerName="Detail Laporan Bulanan">
            <Head title="Detail Laporan Bulanan" />
            <div className="container mx-auto pt-2 pb-6">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <button
                            onClick={handleBack}
                            className="flex items-center mb-4 text-blue-600 hover:text-blue-800 transition-colors"
                        >
                            <FaAngleLeft className="mr-2" />
                            Kembali ke Laporan Bulanan
                        </button>

                        <div>
                            <h1 className="text-2xl font-bold text-gray-800">
                                Detail Laporan Bulanan
                            </h1>
                            <p className="text-gray-600">
                                {laporanInfo
                                    ? `${getMonthName(laporanInfo.bulan)} ${
                                          laporanInfo.tahun
                                      }`
                                    : "Lihat dan kelola detail laporan bulanan RT"}
                            </p>
                        </div>
                    </div>

                    {/* Tombol untuk tambah detail laporan */}
                    {(auth.user.role === "super_admin" ||
                        auth.user.role === "moderator") && (
                        <div className="flex gap-2">
                            <CreateDetailLaporan
                                idRekap={id}
                                idRekapRt={datas[0]?.id_rekap_rt}
                                rtList={rtList.filter(
                                    (rt) =>
                                        auth.user.role === "super_admin" ||
                                        rt.id_rt === auth.user.id_rt
                                )}
                                existingData={filteredData}
                            />
                           
                        </div>
                    )}
                </div>

                {/* Info Summary */}
                {filteredData.length > 0 && (
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div className="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <h3 className="text-sm font-medium text-blue-800">
                                Total RT
                            </h3>
                            <p className="text-2xl font-bold text-blue-900">
                                {filteredData.length}
                            </p>
                        </div>
                        <div className="bg-green-50 p-4 rounded-lg border border-green-200">
                            <h3 className="text-sm font-medium text-green-800">
                                Total Penduduk Awal
                            </h3>
                            <p className="text-2xl font-bold text-green-900">
                                {filteredData.reduce(
                                    (sum, item) =>
                                        sum + (item.total_penduduk_awal || 0),
                                    0
                                )}
                            </p>
                        </div>
                        <div className="bg-purple-50 p-4 rounded-lg border border-purple-200">
                            <h3 className="text-sm font-medium text-purple-800">
                                Total Penduduk Akhir
                            </h3>
                            <p className="text-2xl font-bold text-purple-900">
                                {filteredData.reduce(
                                    (sum, item) =>
                                        sum + (item.jumlah_penduduk_akhir || 0),
                                    0
                                )}
                            </p>
                        </div>
                        <div className="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <h3 className="text-sm font-medium text-yellow-800">
                                Total KK
                            </h3>
                            <p className="text-2xl font-bold text-yellow-900">
                                {filteredData.reduce(
                                    (sum, item) => sum + (item.jumlah_kk || 0),
                                    0
                                )}
                            </p>
                        </div>
                    </div>
                )}

                {/* Tabel Data */}
                <div className="bg-white rounded-lg shadow">
                    <GenericTable
                        data={filteredData}
                        columns={columns}
                        onRowClick={handleRowClick}
                        pageSize={10}
                    />
                </div>

                <div className="mt-4 text-sm text-gray-500">
                    Total {filteredData.length} RT dalam laporan ini
                    {auth.user.role === "moderator" && " (hanya RT Anda)"}
                </div>

                {/* Modal Detail Laporan */}
                {showDetailModal && (
                    <DetailLaporanModal
                        datas={modalData}
                        onClose={() => setShowDetailModal(false)}
                        onOpen={showDetailModal}
                    />
                )}
            </div>
        </AuthenticatedLayout>
    );
};

export default DetailLaporanBulanan;
