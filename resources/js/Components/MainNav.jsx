import React from "react";
import { Head, useForm } from "@inertiajs/react";

import NavLink from "./NavLink";
// import Logo from "./Logo";
import { MdFileDownload } from "react-icons/md";
import Dropdown from "./Dropdown";
import { FaUserCircle } from "react-icons/fa";

const MainNav = () => {
    const { post } = useForm();
    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"), {
            onFinish: () => (window.location.href = "/"), // Force redirect ke halaman utama
        });
    };
    return (
        <div className="bg-blue-800">
            <nav className="w-full h-full ">
                <div className="flex flex-col h-full">
                    <div className="flex flex-col items-center py-2  gap-3 ">
                        <span className="text-2xl font-bold uppercase text-white">
                            Desa Salo Cella
                        </span>
                        <div class="border-t border-blue-200 w-full shadow-sm  "></div>
                    </div>
                    <div className="flex flex-col items-center py-6  justify-between h-full ">
                        {/* <Logo /> */}
                            <NavLink
                                containerStyles="flex flex-col gap-4 w-full px-6 text-white"
                                childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-2 hover:bg-blue-700/80 transition-all duration-300 "
                            />
                        <div className=" w-full px-6">
                            <Dropdown>
                                <Dropdown.Trigger>
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
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    );
};

export default MainNav;
