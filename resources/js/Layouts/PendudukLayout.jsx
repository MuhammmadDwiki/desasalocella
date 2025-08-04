import Header from "@/Components/Header";
import MainNav from "@/Components/MainNav";

export default function PendudukLayout({ children, headerName })
{
    return(
         <div className="flex h-screen overflow-hidden">
            <div className="hidden xl:flex w-64 h-full  ">
                <MainNav />
            </div>
            <div className="flex-1 flex flex-col min-h-0 overflow-hidden">
                <Header headerName={headerName} />
                <div className="flex-1 overflow-auto ">
                    <section className="container mx-auto p-4">
                        <div>{children}</div>
                    </section>
                </div>
            </div>
        </div>
    )



}