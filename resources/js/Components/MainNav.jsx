import React from "react";
import { Head } from "@inertiajs/react";
import NavLink from "./NavLink";
// import Logo from "./Logo";
import { MdFileDownload } from "react-icons/md";

const MainNav = () => {
    return (
        <div className="bg-black">
            <nav className="w-full ">
                <div className="flex flex-col h-full ">
                    <div className="flex flex-col items-center py-2  gap-3 ">
                        <span className="text-2xl font-bold uppercase text-white">
                            Desa Salo Cella
                        </span>
                        <div class="border-t border-gray-300 w-full  "></div>
                    </div>
                    <div className="flex flex-col items-center pt-6  justify-between h-full ">
                        {/* <Logo /> */}
                        <NavLink
                            containerStyles="flex flex-col gap-4 w-full px-6 text-white"
                            childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-2 hover:bg-neutral-400 transition-all duration-300 "
                        />

                        <button className="btn btn-lg btn-tertiary mb-16 ">
                            <div className="flex items-center gap-3">
                                <span>Download CV</span>
                                <MdFileDownload className="text-xl" />
                            </div>
                        </button>
                        
                    </div>
                </div>
            </nav>
        </div>
    );
};

export default MainNav;
