import { ScrollArea } from "@/components/ui/scroll-area";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import {
    Bar,
    BarChart,
    CartesianGrid,
    XAxis,
    Pie,
    PieChart,
    LabelList,
    Line,
    LineChart,
} from "recharts";
import { format } from "date-fns";
import { id } from "date-fns/locale";

import {
    ChartContainer,
    ChartLegend,
    ChartLegendContent,
    ChartTooltip,
    ChartTooltipContent,
} from "@/components/ui/chart";

const chartConfig = {
    laki: {
        label: "Laki-laki",
        color: "#3b82f6",
    },
    perempuan: {
        label: "Perempuan",
        color: "#ec4899",
    },
};
const chartConfigBar2 = {
    lakiDatang: {
        label: "Laki-laki Datang",
        color: "#009990",
    },
    lakiPindah: {
        label: "laki-laki Pindah",
        color: "#5EABD6",
    },
    perempuanDatang: {
        label: "perempuan Datang",
        color: "#FF6868",
    },
    perempuanPindah: {
        label: "perempuan pindah",
        color: "#F564A9",
    },
};
const chartConfigLine = {
    totalDatang: {
        label: "total datang",
        color: "#009990",
    },
    totalPindah: {
        label: "total Pindah",
        color: "#FF6868",
    },
};

export default function Dashboard({
    summary,
    detailData,
    ageGroups,
    lastUpdated,
    pendudukByBulan,
}) {
    // console.log(
    //     "summary :",
    //     summary,
    //     "\ndetail Data :",
    //     detailData,
    //     ageGroups,
    //     "\nPenduduk By bulan",
    //     pendudukByBulan
    // );

    const columnHelper = createColumnHelper();
    const column = [
        columnHelper.accessor("kelompok_umur", {
            header: "Kelompok Umur",
            cell: (info) => (
                <span className="font-medium">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("laki", {
            header: "Laki-laki",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("perempuan", {
            header: "Perempuan",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("total", {
            header: "Total",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
    ];
    return (
        <AuthenticatedLayout headerName="Dashboard">
            <Head title="Dashboard" />
            <div className="flex flex-col gap-6 container mx-auto mb-10">
                <div className="bg-white rounded-lg shadow p-6">
                    <div className="flex items-center justify-between">
                        <h1 className="text-xl font-semibold mb-4">Summary</h1>
                        <p className="text-md text-gray-500 italic">
                            {lastUpdated
                                ? `Terakhir diubah ${format(
                                      lastUpdated,
                                      "PPP",
                                      { locale: id }
                                  )}`
                                : ""}
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {/* Card 1 */}
                        <div className="bg-blue-50 p-4 rounded-lg">
                            <h2 className="text-lg font-semibold">
                                Total Penduduk
                            </h2>
                            <p className="text-3xl font-bold mt-2">
                                {summary?.totalPenduduk.toLocaleString("id-ID")}
                            </p>
                        </div>

                        {/* Card 2 */}
                        <div className="bg-green-50 p-4 rounded-lg">
                            <h2 className="text-lg font-semibold">
                                Penduduk Datang
                            </h2>
                            <p className="text-3xl font-bold mt-2">
                                {summary?.totalDatang.toLocaleString("id-ID")}
                            </p>
                        </div>

                        {/* Card 3 */}
                        <div className="bg-red-50 p-4 rounded-lg">
                            <h2 className="text-lg font-semibold">
                                Penduduk Pindah
                            </h2>
                            <p className="text-3xl font-bold mt-2">
                                {summary?.totalPindah.toLocaleString("id-ID")}
                            </p>
                        </div>
                    </div>
                </div>
                <div className="bg-white rounded-lg shadow p-6">
                    <h1 className="text-xl font-semibold mb-4">
                        Distribusi kelompok Umur
                    </h1>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div className="md:max-w-[500px] h-[260px] md:h-[220px] px-2 py-1">
                            <ChartContainer
                                config={chartConfig}
                                className="w-full h-full "
                            >
                                <BarChart accessibilityLayer data={ageGroups} className="" >
                                    <CartesianGrid vertical={false} />
                                    <XAxis
                                        dataKey="kelompok_umur"
                                        tickLine={false}
                                        tickMargin={10}
                                        axisLine={false}
                                        tickFormatter={(value) =>
                                            value.slice(0, 6)
                                        }
                                    />
                                    <ChartTooltip
                                        content={
                                            <ChartTooltipContent hideLabel />
                                        }
                                    />
                                    <ChartLegend
                                        content={<ChartLegendContent />}
                                    />
                                    
                                    <Bar
                                        dataKey="laki"
                                        fill="var(--color-laki)"
                                        radius={[4, 4, 0, 0]}
                                    
                                    />
                                    <Bar
                                        dataKey="perempuan"
                                        fill="var(--color-perempuan)"
                                        radius={[4, 4, 0, 0]}
                                    />
                                </BarChart>
                            </ChartContainer>
                        </div>
                        <div className="">
                            <GenericTable
                                data={ageGroups}
                                columns={column}
                                onRowClick={() => {}}
                                pagination={false}
                                pageSize={5}
                            />
                        </div>
                    </div>
                </div>
                <div className="bg-white rounded-lg shadow p-6">
                    <h1 className="text-xl font-semibold mb-4">
                        Perpindahan Penduduk
                    </h1>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div className="md:max-w-[500px] h-[260px] md:h-[220px] px-2 py-1">
                            <ChartContainer
                                config={chartConfigBar2}
                                className="w-full h-full"
                            >
                                <BarChart
                                    accessibilityLayer
                                    data={[summary]}
                                    margin={{
                                        top: 0,
                                        left: 20,
                                        right: 20,
                                    }}
                                >
                                    <CartesianGrid vertical={false} />
                                    <ChartTooltip
                                        content={
                                            <ChartTooltipContent hideLabel />
                                        }
                                    />
                                    <ChartLegend
                                        content={<ChartLegendContent />}
                                    />
                                    <Bar
                                        dataKey="lakiDatang"
                                        fill="var(--color-lakiDatang)"
                                        radius={4}
                                    >
                                        <LabelList
                                            position="top"
                                            offset={12}
                                            className="fill-foreground"
                                            fontSize={12}
                                        />
                                    </Bar>
                                    <Bar
                                        dataKey="perempuanDatang"
                                        fill="var(--color-perempuanDatang)"
                                        radius={4}
                                    >
                                        <LabelList
                                            position="top"
                                            offset={12}
                                            className="fill-foreground"
                                            fontSize={12}
                                        />
                                    </Bar>
                                    <Bar
                                        dataKey="lakiPindah"
                                        fill="var(--color-lakiPindah)"
                                        radius={4}
                                    >
                                        <LabelList
                                            position="top"
                                            offset={12}
                                            className="fill-foreground"
                                            fontSize={12}
                                        />
                                    </Bar>
                                    <Bar
                                        dataKey="perempuanPindah"
                                        fill="var(--color-perempuanPindah)"
                                        radius={4}
                                    >
                                        
                                        <LabelList
                                            position="top"
                                            offset={12}
                                            className="fill-foreground"
                                            fontSize={12}
                                        />
                                    </Bar>
                                </BarChart>
                            </ChartContainer>
                        </div>
                        <div className="md:max-w-[500px] h-[260px]  md:h-[220px] px-2 py-1">
                            <ChartContainer
                                config={chartConfigLine}
                                className="w-full h-full"
                            >
                                <LineChart
                                    accessibilityLayer
                                    data={pendudukByBulan}
                                >
                                    <ChartLegend
                                        content={<ChartLegendContent />}
                                    />
                                    <CartesianGrid vertical={false} />
                                    <XAxis
                                        dataKey="bulan"
                                        tickLine={true}
                                        axisLine={true}
                                        tickMargin={8}
                                        tickSize={4}
                                        tickFormatter={(value) =>
                                            value.slice(0, 3)
                                        }
                                        padding={{
                                            left: 20,
                                            right: 20
                                        }}


                                    />

                                    <ChartTooltip
                                        cursor={true}
                                        content={<ChartTooltipContent />}
                                    />
                                    <Line
                                        dataKey="totalDatang"
                                        type="monotone"
                                        stroke="var(--color-totalDatang)"
                                        strokeWidth={2}
                                        dot={true}

                                    />
                                    <Line
                                        dataKey="totalPindah"
                                        type="monotone"
                                        stroke="var(--color-totalPindah)"
                                        strokeWidth={2}
                                        dot={true}
                                    />
                                </LineChart>
                            </ChartContainer>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
