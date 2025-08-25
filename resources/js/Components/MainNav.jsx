import React from "react";
import { Head, useForm, router ,usePage} from "@inertiajs/react";
// import { router } from '@inertiajs/react';

import NavLink from "./NavLink";
// import Logo from "./Logo";
import { MdFileDownload } from "react-icons/md";
import Dropdown from "./Dropdown";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

import { FaUserCircle } from "react-icons/fa";
import { MdOutlineLogout } from "react-icons/md";
const MainNav = () => {
    const { post } = useForm();
    const { auth } = usePage().props;
    // console.log(auth)
    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"), {
            onFinish: () => (window.location.href = "/"),
        });
    };
    return (
        <div className="bg-red-800 relative">
            <nav className="w-full h-screen ">
                <div className="flex flex-col h-screen">
                    <div className="flex flex-col items-center py-3 pt-5 mb-4 gap-3 border-b border-white/45 w-full shadow-sm ">
                        <span className="text-2xl font-bold uppercase text-white">
                            Desa Salo Cella
                        </span>
                        <div class=" "></div>
                    </div>
                    <div className="flex flex-col  items-center  h-full">
                        <div className="flex flex-auto  max-h-[clamp(100px,60dvh,70vh)] overflow-y-auto flex-col items-center justify-between pt-2">
                            <NavLink
                                containerStyles="flex flex-col gap-4 w-full px-6 text-white"
                                childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-2 hover:bg-red-700/80 transition-all duration-300 "
                            />
                        </div>

                        <div className=" flex items-end justify-center flex-1 z-2 w-full px-6">
                            <div className="mb-6">
                                <div className="text-sm flex flex-col justify-center items-center text-gray-200 ">
                                    <p>{auth.user.email}</p>
                                    <p className="italic">{auth?.user.role == 'super_admin' ? "admin" : auth?.user.role }</p>
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
                    </div>
                </div>
            </nav>
        </div>
    );
};

export default MainNav;
