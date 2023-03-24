import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router";
import api from "../../services/api";

const UpdateTipos = () => {

    const [tipo, setTipo] = useState<string>('');
    const [Fator, setFator] = useState<string>('');
    const navigate = useNavigate();
    const {id} = useParams(); 

    useEffect(() => {
        api.get(`/tipos/${id}`)
            .then(response => {
                setTipo(response.data.tipo);
                setFator(response.data.Fator);
            })
    },[id]);  
  
    const handleUpdateTipo = async (event : React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
      

        const data = {
            id: parseInt(String(id)),
            tipo,
            Fator
        };

        try {
           await api.put('/tipos', data);
            alert("Tipo sanguineio atualizado com sucesso!");
            navigate('/tipos');
        } catch (error) {
            console.error(error);
            alert("Erro ao atualizar tipo sanguineio!")   
        }
    }
    return(
        <div>
            <h2>Atualização de Tipo: {tipo} - {Fator}</h2>
            <form onSubmit={handleUpdateTipo}>
                <div>
                    <label htmlFor="tipo">Tipo</label>
                    <select name="tipo" id="tipo"  value={tipo} onChange={e => setTipo(e.target.value)}>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div>
                    <label htmlFor="Fator">Fator</label>
                    
                    <select name="Fator" id="Fator"  value={Fator} onChange={e => setFator(e.target.value)}>
                        <option value="Positivo">Positivo</option>
                        <option value="Negativo">Negativo</option>
                    </select>
                </div>
                <button type="submit">Atualizar</button>
                <button type="reset">Limpar</button>
            </form>
            
        </div>
    );
}
export default UpdateTipos;