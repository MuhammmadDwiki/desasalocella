import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/components/ui/sheet";
import { CiMenuFries } from "react-icons/ci";
import NavLink from "./NavLink";
import Dropdown from "./Dropdown";
import { Link, useForm, usePage, router } from "@inertiajs/react";
import { FaUserCircle } from "react-icons/fa";
import { FaSearch } from "react-icons/fa";
import { Input } from "@/components/ui/input";
import { MdOutlineLogout } from "react-icons/md";
import { Bell } from "lucide-react";
import { format, formatDistanceToNow } from "date-fns";
import { id } from "date-fns/locale";
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from "@/components/ui/dropdown-menu";
import { Dot } from "lucide-react";

const NotificationBell = ({ notifications }) => {
    const { auth } = usePage().props;
    const unread = notifications.filter((n) => !n.read_at);
    const unreadCount = unread?.length || 0;
    // console.log(notifications.length);
    // console.log(auth);
    const handleRead = (id, link) => {
        // console.log(id, link);
        router.post(
            route("notifications.markAsRead", { id }),
            {},
            {
                preserveScroll: true,
                onSuccess: () => {
                    // opsional: reload data agar badge langsung hilang
                    // router.reload({ only: ["notifications"] });
                    window.location.href = link;
                },
            }
        );
    };
    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button
                    className="relative mr-4 group cursor-pointer px-2 hover:bg-white"
                    variant="ghost"
                >
                    <Bell className="w-6 h-6 text-gray-700" />

                    {unreadCount > 0 && (
                        <span className="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                            {unreadCount}
                        </span>
                    )}
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="max-w-96  bg-white  ">
                <DropdownMenuLabel className="">Notifikasi</DropdownMenuLabel>
                <DropdownMenuSeparator />
                <div className="overflow-x-auto flex flex-col  gap-2 max-h-[70vh]">
                    {(notifications.length == 0) ? (
                        <div className="px-2 py-1">
                            <p className="text-gray-400 text-sm italic">tidak ada notifikasi</p>
                        </div>
                    ): null}
                    {notifications.map((n) => (
                        <div
                            key={n.id}
                            className=""
                            onClick={() => handleRead(n.id, n.data.link)}
                        >
                            <div
                                className={
                                    "text-sm p-2 hover:bg-gray-50 flex flex-col  " +
                                    (n.read_at ? "" : "bg-gray-100")
                                }
                            >
                                <div className="flex justify-end">
                                    <p className="text-xs text-gray-500">
                                        {formatDistanceToNow(n.created_at, {
                                            locale: id,
                                            includeSeconds: true,
                                            addSuffix: true,
                                        })}
                                    </p>
                                </div>
                                <div className="flex gap-2">
                                    <div className="py-1">
                                       <div className={"w-3 h-3  rounded-full " +(n.read_at ? "" : "bg-emerald-600")}></div>
                                    </div>
                                    <div>
                                        <div className="cursor-pointer">
                                            {auth.user.role ===
                                            "super_admin" ? (
                                                <div>
                                                    <div className="">
                                                        <p className="text-md font-semibold capitalize">
                                                            laporan baru oleh Rt{" "}
                                                            {n.data.nomor_rt}{" "}
                                                        </p>
                                                    </div>
                                                    <p className="">
                                                        Laporan pada bulan{" "}
                                                        {n.data.bulan}{" "}
                                                        {n.data.tahun} menunggu
                                                        untuk di validasi.
                                                    </p>
                                                </div>
                                            ) : (
                                                <div>
                                                    <div className={"" +
                                                                (n.read_at ? "" : "text-emerald-600")
                                                            }>
                                                        <p className="text-md font-semibold capitalize">
                                                            laporan anda{" "}
                                                            {n.data.new ===
                                                            "rejected"
                                                                ? "ditolak"
                                                                : "diterima"}
                                                        </p>
                                                    </div>
                                                    <p className={"" +
                                                                (n.read_at ? "" : "text-emerald-600")
                                                            }>
                                                        Laporan pada bulan{" "}
                                                        {n.data.bulan}{" "}
                                                        {n.data.tahun} anda{" "}
                                                        {n.data.new ===
                                                        "rejected"
                                                            ? "ditolak"
                                                            : "diterima"}
                                                        .
                                                    </p>
                                                    {n.data.catatan && (
                                                        <p className="text-xs text-gray-500">
                                                            {n.data.catatan}
                                                        </p>
                                                    )}
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {/* {notifications.length > 1 && (
                            <div className="w-full h-[1px] bg-gray-400 "></div>
                        )} */}
                        </div>
                    ))}
                </div>
            </DropdownMenuContent>
            {/* {unreadCount > 0 && (
        <div className="absolute top-8 right-0 w-72 max-h-96 overflow-y-auto bg-white shadow-lg rounded-md border p-2 hidden group-hover:block">
          {notifications.map(n => (
            <div key={n.id} className="text-sm p-2 border-b">
                <div className="flex justify-end">
                    <p className="text-xs text-gray-500">{format(n.updated_at, 'Pp', {locale: id})}</p>
                </div>
                <div className="">
                    <p className="text-md font-semibold capitalize">laporan anda {n.data.new === 'rejected' ? 'ditolak' : 'diterima'}</p>
                </div>
              <p className="">Laporan pada bulan {n.data.bulan} {n.data.tahun} anda {n.data.new === 'rejected' ? 'ditolak' : 'diterima'}</p>
              {n.data.catatan && (
                <p className="text-xs text-gray-500">{n.data.catatan}</p>
              )}
            </div>
          ))}
        </div>
      )}  */}
        </DropdownMenu>
    );
};

const Header = (props) => {
    const { post } = useForm();
    const { auth } = usePage().props;
    const { notifications } = usePage().props;

    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"), {
            onFinish: () => (window.location.href = "/"), // Force redirect ke halaman utama
        });
    };
    return (
        <header className="w-full border shadow-md flex z-80 ">
            <div className="container mx-auto ">
                <div className="flex items-center justify-between py-4">
                    <div className="flex ms-4">
                        <div className="text-lg">
                            <h1>{props.headerName}</h1>
                        </div>
                    </div>

                    <div className="flex items-center">
                        <NotificationBell notifications={notifications} />
                        <div className="pe-4">
                            <Input
                                type="search"
                                placeholder={`Search`}
                                className="rounded-xl"
                            />
                        </div>
                        {/* <div>
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <div className="flex rounded-md items-center">
                                        <button
                                            type="button"
                                            className="flex items-center  gap-2  px-3 py-1 text-md font-medium leading-4 text-gray-600 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        >
                                            <FaUserCircle className="text-4xl" />
                                            <span className="flex flex-col">
                                                <p>John Doe</p>
                                                <p className="text-sm">admin</p>
                                            </span>
                                        </button>
                                    </div>
                                </Dropdown.Trigger>

                                <Dropdown.Content>
                                    <form onSubmit={handleLogout}>
                                        <button type="submit" className="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none ">Log Out</button>
                                    </form>
                                </Dropdown.Content>
                            </Dropdown>
                        </div> */}

                        {/* <div className="ms-6 flex items-center pe-10">
                            <div className="relative ms-3">
                                <form onSubmit={handleLogout}>
                                    <button type="submit">Log Out</button>
                                </form>
                            </div>
                        </div> */}

                        <div className="xl:hidden block ">
                            <Sheet>
                                <SheetTrigger className="cursor-pointer text-[30px] text-black">
                                    <CiMenuFries />
                                </SheetTrigger>

                                <SheetContent
                                    className="bg-primary border-0 flex flex-col justify-center items-center pt-16 pb-10 bg-red-800"
                                    side="left"
                                >
                                    <SheetHeader className="">
                                        {/* <SheetTitle>
                                    <Logo />
                                </SheetTitle> */}
                                        <SheetDescription className="sr-only text-white">
                                            Navigation Menu
                                        </SheetDescription>
                                    </SheetHeader>
                                    <div className="flex flex-col  items-center w-full  h-full ">
                                        <div className="flex flex-auto max-h-[clamp(200px,70dvh,80vh)] w-[inherit] overflow-y-auto flex-col justify-between pt-2">
                                            <NavLink
                                                containerStyles="flex flex-col gap-6 w-full px-6 text-white "
                                                childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-4  hover:bg-red-700/80  transition-all duration-300 "
                                            />
                                        </div>
                                    </div>
                                    <div className=" flex items-end justify-center flex-1 z-2 w-full px-6">
                                        <div className="mb-6">
                                            <div className="text-md flex flex-col justify-center items-center text-gray-200 ">
                                                <p>{auth.user.email}</p>
                                                <p className="italic">
                                                    {auth?.user.role ==
                                                    "super_admin"
                                                        ? "admin"
                                                        : auth?.user.role}
                                                </p>
                                            </div>
                                            <form onSubmit={handleLogout}>
                                                <button
                                                    type="submit"
                                                    className="flex items-center w-full  text-lg gap-2 px-4 justify-center text-white hover:text-gray-300 "
                                                >
                                                    <MdOutlineLogout />
                                                    Log Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </SheetContent>
                            </Sheet>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Header;
