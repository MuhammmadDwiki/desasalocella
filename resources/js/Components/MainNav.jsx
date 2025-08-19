import React from "react";
import { Head, useForm, router } from "@inertiajs/react";
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
                        <div className="flex flex-auto  max-h-[80%] overflow-y-auto flex-col items-center justify-between pt-2">
                            <NavLink
                                containerStyles="flex flex-col gap-4 w-full px-6 text-white"
                                childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-2 hover:bg-red-700/80 transition-all duration-300 "
                            />
                        </div>

                        <div className=" flex items-end justify-center flex-1 z-2 w-full px-6">
                            {/* <DropdownMenu>
                                <DropdownMenuTrigger>
                                    <div className="flex rounded-md items-center">
                                        <button
                                            type="button"
                                            className="flex items-center  gap-6  px-3 py-1 text-lg font-medium leading-4 text-white transition duration-150 ease-in-out hover:text-gray-200 focus:outline-none"
                                        >
                                            <FaUserCircle className="text-4xl" />
                                            <span className="flex flex-col">
                                                <p>John Doe</p>
                                                <p className="text-sm">admin</p>
                                            </span>
                                        </button>
                                    </div>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuLabel>
                                        My Account
                                    </DropdownMenuLabel>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem>
                                        <form onSubmit={handleLogout}>
                                            <button
                                                type="submit"
                                                className="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none "
                                            >
                                                Log Out
                                            </button>
                                        </form>
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu> */}
                            <div className="mb-6">
                                <form onSubmit={handleLogout}>
                                    <button
                                        type="submit"
                                        className="flex items-center w-full  text-lg gap-2 px-4 justify-center text-white hover:text-gray-300"
                                    >
                                        <MdOutlineLogout />

                                        Log Out
                                    </button>
                                </form>
                            </div>
                            {/* <Dropdown>
                                <Dropdown.Trigger >
                                    
                                </Dropdown.Trigger>

                                <Dropdown.Content>
                                    <form onSubmit={handleLogout}>
                                        <button
                                            type="submit"
                                            className="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none "
                                        >
                                            Log Out
                                        </button>
                                    </form>
                                </Dropdown.Content>
                            </Dropdown> */}
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    );
};

export default MainNav;
