
import { BrowserRouter, Route, Routes } from 'react-router-dom';	
import App from './App';
import CreateDoacoes from './components/doacoes/CreateDoacoes';
import ListDoacoes from './components/doacoes/ListDoacoes';
import UpdateDoacoes from './components/doacoes/UpdateDoacoes';
import CreateLocais from './components/locais/CreateLocais';
import ListLocais from './components/locais/ListLocais';
import UpdateLocais from './components/locais/UpdateLocais';
import CreatePessoas from './components/pessoas/CreatePessoas';
import ListPessoas from './components/pessoas/ListPessoas';
import UpdatePessoas from './components/pessoas/UpdatePessoas';
import CreateTipos from './components/tipos/CreateTipos';
import ListTipos from './components/tipos/ListTipos';
import UpdateTipos from './components/tipos/UpdateTipos';

const AppRoutes = () => {

    return(
        <BrowserRouter>

            <Routes>

            <Route path="/" element={<App />} /> 
            <Route path="/tipos" element={<ListTipos/>} />
            <Route path="/tipos/create" element={<CreateTipos/>} />
            <Route path="/tipos/update/:id" element={<UpdateTipos/>} /> 
            <Route path="/locais" element={<ListLocais/>} />
            <Route path="/locais/create" element={<CreateLocais/>} />
            <Route path="/locais/update/:id" element={<UpdateLocais/>} />
            <Route path="/pessoas" element={<ListPessoas/>} />
            <Route path="/pessoas/create" element={<CreatePessoas/>} />
            <Route path="/pessoas/update/:id" element={<UpdatePessoas/>} />
            <Route path="/doacoes" element={<ListDoacoes/>} />
            <Route path="/doacoes/create" element={<CreateDoacoes/>} />
            <Route path="/doacoes/update/:id" element={<UpdateDoacoes/>} />


            </Routes>

        </BrowserRouter>
    )
}

export default AppRoutes;