import React, { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm, usePage } from "@inertiajs/react";
import { GenericTable } from "@/Components/GenericTable";
import { createColumnHelper } from "@tanstack/react-table";
import { FaAngleLeft } from "react-icons/fa";
import CreateDetailLaporan from "@/Components/CreateDetailLaporan";

import { Pencil, Trash2, Eye } from "lucide-react";
import { Button } from "@/components/ui/button";
import DetailLaporanModal from "@/Components/DetailLaporanModal";
import axios from "axios";

const detailLaporan = [
    {
        id_detail_rekap: 1,
        id_rekap: 1,
        id_rt: "RT001",
        kelompok_umur: "0-5",
        jumlah_laki_laki_awal: 10,
        jumlah_perempuan_awal: 8,
        jumlah_laki_laki_akhir: 12,
        jumlah_perempuan_akhir: 9,
        jumlah_laki_laki_pindah: 2,
        jumlah_perempuan_pindah: 1,
        jumlah_laki_laki_datang: 3,
        jumlah_perempuan_datang: 2,
    },
    {
        id_detail_rekap: 2,
        id_rekap: 1,
        id_rt: "RT001",
        kelompok_umur: "6-12",
        jumlah_laki_laki_awal: 15,
        jumlah_perempuan_awal: 14,
        jumlah_laki_laki_akhir: 16,
        jumlah_perempuan_akhir: 15,
        jumlah_laki_laki_pindah: 1,
        jumlah_perempuan_pindah: 0,
        jumlah_laki_laki_datang: 2,
        jumlah_perempuan_datang: 1,
    },
    {
        id_detail_rekap: 3,
        id_rekap: 1,
        id_rt: "RT002",
        kelompok_umur: "0-5",
        jumlah_laki_laki_awal: 8,
        jumlah_perempuan_awal: 7,
        jumlah_laki_laki_akhir: 9,
        jumlah_perempuan_akhir: 8,
        jumlah_laki_laki_pindah: 1,
        jumlah_perempuan_pindah: 1,
        jumlah_laki_laki_datang: 1,
        jumlah_perempuan_datang: 0,
    },
    {
        id_detail_rekap: 3,
        id_rekap: 2,
        id_rt: "RT001",
        kelompok_umur: "0-5",
        jumlah_laki_laki_awal: 18,
        jumlah_perempuan_awal: 7,
        jumlah_laki_laki_akhir: 29,
        jumlah_perempuan_akhir: 8,
        jumlah_laki_laki_pindah: 1,
        jumlah_perempuan_pindah: 1,
        jumlah_laki_laki_datang: 1,
        jumlah_perempuan_datang: 0,
    },
];

const DetailLaporanBulanan = ({ id, datas, rtList }) => {
    const { data, setData, post, processing, errors, reset } = useForm();
    const [modalData, setModalData] = useState([]);
    const [showDetailModal, setShowDetailModal] = useState(false);

    const handleBack = () => {
        router.get("/laporan-bulanan");
    };
    // console.log(datas, id);
    const handleDetailClick = async (row) => {
        const idRt = row?.id_rt;
        const idLaporan = id;
        await axios.get(route("detail-laporan.by-rt", { idLaporan, idRt }))
        .then((res) => {
            // console.log(res.data);
            setModalData(res.data);
            setShowDetailModal(true);
        })
            
            
    };
    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("nomor_rt", {
            header: "Nomor RT",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("total_penduduk_awal",
            {
                header: "Jumlah Awal Penduduk",
                cell: (info) => {
                    // const { jumlah_laki_laki_awal, jumlah_perempuan_awal } =
                    //     info.row.original;
                    // const jumlah_awal =
                    //     jumlah_laki_laki_awal + jumlah_perempuan_awal;
                    return `${info.getValue()} Orang `;
                },
            }
        ),
        columnHelper.accessor("total_penduduk_akhir", {
            header: "Jumlah Akhir Penduduk",
            cell: (info) => {
                return `${info.getValue()} Orang `;
            },
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {

                // console.log("row:", row.original.id);
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            className="bg-blue-600 hover:bg-blue-700"
                            size="icon"
                            onClick={() => handleDetailClick(row.original)}
                        >
                            <Eye className="h-4 w-4 text-white" />
                        </Button>
                        <Button variant="destructive" size="icon">
                            <Trash2 className="h-4 w-4" />
                        </Button>
                        {showDetailModal && (
                            <DetailLaporanModal
                                datas={modalData}
                                onClose={() => setShowDetailModal(false)}
                                onOpen = {showDetailModal}
                            />
                        )}
                    </div>
                );
            },
        }),
    ];
    const handleRowClick = (row) => {};

    return (
        <AuthenticatedLayout headerName="Laporan Bulanan">
            <Head title="Laporan Bulanan" />
            <div className="container mx-auto pt-2 pb-6">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <button
                            onClick={handleBack}
                            className="flex items-center mb-2 text-blue-600 hover:text-blue-800"
                        >
                            <FaAngleLeft className="mr-2" />
                            Kembali
                        </button>

                        <div className="">
                            <h1 className="text-2xl font-bold text-gray-800">
                                Detail Laporan Bulanan
                            </h1>
                            <p className="text-gray-600">
                                Lihat dan kelola semua detail laporan bulanan RT
                            </p>
                        </div>
                    </div>
                    <CreateDetailLaporan idRekap={id} rtList={rtList} />
                </div>
                <GenericTable
                    data={datas}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
            </div>
        </AuthenticatedLayout>
    );
};

export default DetailLaporanBulanan;
