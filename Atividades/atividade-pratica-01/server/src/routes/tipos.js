import { Router } from 'express';
import { GetAllTiposController } from '../controller/tipos/GetAllTiposController.js';
import { GetByIdTiposController } from '../controller/tipos/GetByIdTiposController.js';
import { CreateTiposController } from '../controller/tipos/CreateTiposController.js';
import { UpdateTiposController } from '../controller/tipos/UpdateTiposController.js';
import { DeleteTiposController } from '../controller/tipos/DeleteTiposController.js';

const tiposRouter = Router();

//CRUD - TIPOS


//SELECT/GET ALL
const getAllTiposController = new GetAllTiposController();
tiposRouter.get('/tipos', getAllTiposController.handle);
//SELECT BY ID
const getByIdTiposController = new GetByIdTiposController();
tiposRouter.get('/tipos/:id', getByIdTiposController.handle);
//CREATE
const createTiposController = new CreateTiposController();
tiposRouter.post('/tipos', createTiposController.handle);
//UPDATE
const updateTiposController = new UpdateTiposController();
tiposRouter.put('/tipos', updateTiposController.handle);

//DELETE
const deleteTiposController = new DeleteTiposController();
tiposRouter.delete('/tipos', deleteTiposController.handle);


export { tiposRouter };