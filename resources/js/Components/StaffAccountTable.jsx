import {

  createColumnHelper,
  flexRender,
  getCoreRowModel,
  useReactTable,
} from "@tanstack/react-table";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/Components/ui/table";
import { Button } from "@/Components/ui/button";
import { Pencil, Trash2 } from "lucide-react";

// Tipe data untuk akun staff
/**
 * @typedef {Object} StaffAccount
 * @property {number} id
 * @property {string} name
 * @property {string} email
 * @property {"Super Admin" | "Moderator"} role
 * @property {string[]} assignedRT
 * @property {string} lastLogin
 */
const columnHelper = createColumnHelper();
const columns = [
  columnHelper.accessor("name", {
    header: "Nama",
    cell: (info) => <span className="font-medium">{info.getValue()}</span>,
  }),
  columnHelper.accessor("email", {
    header: "Email",
    cell: (info) => <span className="text-blue-600">{info.getValue()}</span>,
  }),
  columnHelper.accessor("role", {
    header: "Role",
    cell: (info) => (
      <span
        className={`px-2 py-1 rounded-full text-xs ${
          info.getValue() === "Super Admin"
            ? "bg-purple-100 text-purple-800"
            : "bg-blue-100 text-blue-800"
        }`}
      >
        {info.getValue()}
      </span>
    ),
  }),
  columnHelper.accessor("assignedRT", {
    header: "RT Bertanggung Jawab",
    cell: (info) => (
      <div className="flex flex-wrap gap-1">
        {info.getValue().map((rt, index) => (
          <span 
            key={index}
            className="bg-gray-100 px-2 py-1 rounded text-xs"
          >
            {rt}
          </span>
        ))}
      </div>
    ),
  }),
  columnHelper.accessor("lastLogin", {
    header: "Terakhir Login",
    cell: (info) => (
      <span className="text-gray-500 text-sm">
        {new Date(info.getValue()).toLocaleString()}
      </span>
    ),
  }),
  columnHelper.display({
    id: "actions",
    header: "Aksi",
    cell: ({ row }) => (
      <div className="flex space-x-2">
        <Button variant="outline" size="icon">
          <Pencil className="h-4 w-4" />
        </Button>
        <Button variant="destructive" size="icon">
          <Trash2 className="h-4 w-4" />
        </Button>
      </div>
    ),
  }),
];
/**
 * @param {{ data: StaffAccount[] }} props
 */

export function StaffAccountTable({ data }) {
  const table = useReactTable({
    data,
    columns,
    getCoreRowModel: getCoreRowModel(),
  });

  return (
    <div className="rounded-md border">
      <Table>
        <TableHeader>
          {table.getHeaderGroups().map((headerGroup) => (
            <TableRow key={headerGroup.id}>
              {headerGroup.headers.map((header) => (
                <TableHead key={header.id} className="bg-gray-50">
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
              >
                {row.getVisibleCells().map((cell) => (
                  <TableCell key={cell.id}>
                    {flexRender(cell.column.columnDef.cell, cell.getContext())}
                  </TableCell>
                ))}
              </TableRow>
            ))
          ) : (
            <TableRow>
              <TableCell colSpan={columns.length} className="h-24 text-center">
                Tidak ada data staff
              </TableCell>
            </TableRow>
          )}
        </TableBody>
      </Table>
    </div>
  );
}