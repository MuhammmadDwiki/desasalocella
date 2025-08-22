import {
    flexRender,
    getCoreRowModel,
    useReactTable,
    getPaginationRowModel,
} from "@tanstack/react-table";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

import { Button } from "@/components/ui/button";

import { Pagination } from "./Pagination";
import { cn } from "@/lib/utils"


/**
 * 
 *
 * @param {object} props
 * @param {Array} props.data - Data untuk ditampilkan
 * @param {Array} props.columns - Konfigurasi kolom tabel
 * @returns
 */
export function GenericTable({
    data,
    columns,
    onRowClick,
    pagination = true,
    pageSize = 10,
}) {
    const table = useReactTable({
        data,
        columns,
        getCoreRowModel: getCoreRowModel(),
        getPaginationRowModel: getPaginationRowModel(),
        initialState: {
            pagination: {
                pageIndex: 0,
                pageSize: pageSize,
            },
        },
    });

    const handleRowClick = (row) => {
        if (onRowClick) {
            onRowClick(row.original);
        }
    };

    return (
        <div className="rounded-md border overflow-y-auto">
            <Table className="min-w-full divide-y divide-gray-200 ">
                <TableHeader className="">
                    {table.getHeaderGroups().map((headerGroup) => (
                        <TableRow key={headerGroup.id}>
                            {headerGroup.headers.map((header) => (
                                <TableHead
                                    key={header.id}
                                    className="bg-gray-50 capitalize text-start"
                                >
                                    {header.isPlaceholder
                                        ? null
                                        : flexRender(
                                              header.column.columnDef.header,
                                              header.getContext()
                                          )}
                                </TableHead>
                            ))}
                        </TableRow>
                    ))}
                </TableHeader>
                <TableBody>
                    {table.getRowModel().rows?.length ? (
                        table.getRowModel().rows.map((row) => (
                            <TableRow
                                key={row.id}
                                data-state={row.getIsSelected() && "selected"}
                                onClick={() => handleRowClick(row)}
                                className={
                                    onRowClick
                                        ? " hover:bg-gray-50"
                                        : ""
                                }
                            >
                                {row.getVisibleCells().map((cell) => (
                                    <TableCell key={cell.id}>
                                        {flexRender(
                                            cell.column.columnDef.cell,
                                            cell.getContext()
                                        )}
                                    </TableCell>
                                ))}
                            </TableRow>
                        ))
                    ) : (
                        <TableRow>
                            <TableCell
                                colSpan={columns.length}
                                className="h-24 text-center"
                            >
                                Tidak ada data
                            </TableCell>
                        </TableRow>
                    )}
                </TableBody>
            </Table>
            <div className="flex items-center justify-end me-6 space-x-2 py-4">
                {pagination && (
                    <div className="flex items-center gap-2 justify-between mt-4">
                        <div className="flex items-center space-x-2">
                            <span className="text-sm text-gray-500">
                                Baris per halaman:
                            </span>
                            <Select
                                value={`${
                                    table.getState().pagination.pageSize
                                }`}
                                onValueChange={(value) => {
                                    table.setPageSize(Number(value));
                                }}
                            >
                                <SelectTrigger className="w-16 h-8">
                                    <SelectValue
                                        placeholder={
                                            table.getState().pagination.pageSize
                                        }
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    {[5, 10, 20, 30, 40, 50,100].map((pageSize) => (
                                        <SelectItem
                                            key={pageSize}
                                            value={`${pageSize}`}
                                        >
                                            {pageSize}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                        </div>

                        <Pagination
                            className={'ms-5 gap-2'}
                            currentPage={
                                table.getState().pagination.pageIndex + 1
                            }
                            totalPages={table.getPageCount()}
                            onPageChange={(page) =>
                                table.setPageIndex(page - 1)
                            }
                        />
                    </div>
                )}
            </div>
        </div>
    );
}
