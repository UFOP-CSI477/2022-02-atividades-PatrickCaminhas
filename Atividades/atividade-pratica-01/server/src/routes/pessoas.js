import { Router } from "express";
import { GetAllPessoasController } from "../controller/pessoas/GetAllPessoasController.js";
import { GetByIdPessoasController } from "../controller/pessoas/GetByIdPessoasController.js";
import { CreatePessoasController } from "../controller/pessoas/CreatePessoasController.js";
import { UpdatePessoasController } from "../controller/pessoas/UpdatePessoasController.js";
import { DeletePessoasController } from "../controller/pessoas/DeletePessoasController.js";

const pessoasRouter = Router();

//CRUD - PESSOAS

//SELECT/GET ALL

const getAllPessoasController = new GetAllPessoasController();
pessoasRouter.get("/pessoas", getAllPessoasController.handle);

//GET BY ID
const getByIdPessoasController = new GetByIdPessoasController();
pessoasRouter.get("/pessoas/:id", getByIdPessoasController.handle);

//CREATE
const createPessoasController = new CreatePessoasController();
pessoasRouter.post("/pessoas", createPessoasController.handle);

//UPDATE
const updatePessoasController = new UpdatePessoasController();
pessoasRouter.put("/pessoas", updatePessoasController.handle);

//DELETE
const deletePessoasController = new DeletePessoasController();
pessoasRouter.delete("/pessoas", deletePessoasController.handle);

export { pessoasRouter };