DROP DATABASE IF EXISTS softedu;

CREATE DATABASE softedu;

USE softedu;

CREATE TABLE IF NOT EXISTS softedu.categoriaatividade
(
	idcategoriaAtividade INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao VARCHAR(100) NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.tipoimagem
(
	idtipoimagem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tipoimagem VARCHAR(45) NOT NULL,
	descricao VARCHAR(45) NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.imagenstabuleiro
(
	idimagenstabuleiro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	urlImagem VARCHAR(45) NOT NULL,
	tipoimagemid INT NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.nivelatividade 
(
	idnivelAtividade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricaoNivel VARCHAR(45) NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.perfilusuario 
(
	idPerfilUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(45) NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.tabuleiro 
(
	idtabuleiro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	usuarioid INT NOT NULL,
	plantaTabuleiro VARCHAR(1000) NOT NULL,
	descricao VARCHAR(50) NOT NULL,
	dataCriacao DATE NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.tabuleiro_imagenstabuleiro 
(
	idtabuleiro_imagenstabuleiro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tabuleiroID INT NOT NULL,
	imagenstabuleiroID INT NOT NULL,
	posicaoTabuleiro INT NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.usuario 
(
	idusuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nomeCompletoUsuario VARCHAR(50) NOT NULL,
	senha VARCHAR(256) NOT NULL,
	login VARCHAR(45) NOT NULL,
	dataCadastro DATE NOT NULL,
	perfilUsuarioID INT NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.historicoacessos 
(
	idhistoricoacessos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idusuarioid INT NOT NULL,
	hora_data DATETIME NOT NULL,
	tempoacesso TIME NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.atividade 
(
	idatividade INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(100) NOT NULL,
	categoriaatividadeid INT NOT NULL,
	nivelatividadeid INT NOT NULL
)
AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS softedu.atividade_aluno
(
	idatividade_aluno INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	descricaoatividade VARCHAR(100) NOT NULL,
	tabuleiroid INT NOT NULL,
	usuarioid INT NOT NULL,
	`status` VARCHAR(45) NOT NULL,
	datainicio DATETIME  NOT NULL,
    datafim DATETIME  NOT NULL,
	atividadeid INT NOT NULL
)
AUTO_INCREMENT = 1;

CREATE UNIQUE INDEX urlImagem_UNIQUE ON softedu.imagenstabuleiro(urlImagem ASC);
CREATE INDEX imagenstabuleiro_tipoimagem_idx ON softedu.imagenstabuleiro (tipoimagemid ASC);
CREATE INDEX tabuleiro_imagenstabuleiro_tabuleiro_idx ON softedu.tabuleiro_imagenstabuleiro (tabuleiroID ASC);
CREATE INDEX tabuleiro_imagenstabuleiro_imgstabuleiro_idx ON softedu.tabuleiro_imagenstabuleiro (imagenstabuleiroID ASC);
CREATE UNIQUE INDEX login_UNIQUE ON softedu.usuario (login ASC);
CREATE INDEX idPerfilUsuario_idx ON softedu.usuario (perfilUsuarioID ASC);
CREATE INDEX atividade_categoriaatividadeid_idx ON softedu.atividade (categoriaatividadeid ASC);
CREATE INDEX atividade_nivelatividade_idx ON softedu.atividade (nivelatividadeid ASC);
CREATE INDEX atividade_aluno_tabuleiro_idx ON softedu.atividade_aluno (tabuleiroid ASC);
CREATE INDEX atividade_aluno_usuario_idx ON softedu.atividade_aluno (usuarioid ASC);
CREATE INDEX atividade_aluno_atividade_idx ON softedu.atividade_aluno (atividadeid ASC);

ALTER TABLE softedu.atividade 
	ADD CONSTRAINT fk_atividade_nivelatividade 
		FOREIGN KEY (nivelatividadeid)
			REFERENCES softedu.nivelatividade(idnivelAtividade);
            
ALTER TABLE softedu.atividade 
	ADD CONSTRAINT fk_atividade_categoriaatividade 
		FOREIGN KEY (categoriaatividadeid)
			REFERENCES softedu.categoriaatividade(idcategoriaAtividade);

ALTER TABLE softedu.usuario
	ADD CONSTRAINT fk_usuario_perfilusuario 
		FOREIGN KEY (perfilUsuarioID)
			REFERENCES softedu.perfilusuario(idPerfilUsuario);

ALTER TABLE softedu.historicoacessos
	ADD CONSTRAINT fk_historicoacessos_usuario 
		FOREIGN KEY (idusuarioid)
			REFERENCES softedu.usuario(idusuario);

ALTER TABLE softedu.imagenstabuleiro
	ADD CONSTRAINT fk_imagenstabuleiro_tipoimagem 
		FOREIGN KEY (tipoimagemid)
			REFERENCES softedu.tipoimagem(idtipoimagem);

ALTER TABLE softedu.atividade_aluno 
	ADD CONSTRAINT fk_atividadealuno_atividade 
		FOREIGN KEY (atividadeid)
			REFERENCES softedu.atividade(idatividade);

ALTER TABLE softedu.atividade_aluno
	ADD CONSTRAINT fk_atividadealuno_usuario 
		FOREIGN KEY (usuarioid)
			REFERENCES softedu.usuario(idusuario);
            
ALTER TABLE softedu.tabuleiro_imagenstabuleiro
	ADD CONSTRAINT fk_tabuleiroimagenstabuleiro_imagenstabuleiro 
		FOREIGN KEY (imagenstabuleiroid)
			REFERENCES softedu.imagenstabuleiro(idimagenstabuleiro);

ALTER TABLE softedu.atividade_aluno 
	ADD CONSTRAINT fk_atividadealuno_tabuleiro 
		FOREIGN KEY (tabuleiroid)
			REFERENCES softedu.tabuleiro(idtabuleiro);

ALTER TABLE softedu.tabuleiro
	ADD CONSTRAINT fk_tabuleiro_usuario 
		FOREIGN KEY (usuarioid)
			REFERENCES softedu.usuario(idusuario);

ALTER TABLE softedu.tabuleiro_imagenstabuleiro
	ADD CONSTRAINT fk_tabuleiroimagenstabuleiro_tabuleiro 
		FOREIGN KEY (tabuleiroID)
			REFERENCES softedu.tabuleiro(idtabuleiro);

INSERT INTO perfilusuario (descricao)
	VALUES ('Aluno'),
		   ('Professor'),
           ('Coordenador'),
           ('Diretor');

CREATE VIEW  atividades AS
SELECT idatividade, atividade.descricao, categoriaatividade.descricao 'descricaoCategoria', nivelatividade.descricaoNivel
	FROM softedu.atividade
		INNER JOIN softedu.nivelatividade ON atividade.nivelatividadeid = nivelatividade.idnivelAtividade
        INNER JOIN softedu.categoriaatividade ON atividade.categoriaatividadeid = categoriaatividade.idcategoriaAtividade;
        
CREATE VIEW tabuleiros AS 
SELECT idtabuleiro, descricao, usuarioid, nomeCompletoUsuario nome, plantaTabuleiro, dataCriacao
	FROM softedu.tabuleiro
		INNER JOIN softedu.usuario ON tabuleiro.usuarioid = usuario.idusuario;

CREATE VIEW tipodaimagem AS
SELECT idimagenstabuleiro, ti.tipoimagem
	FROM imagenstabuleiro it
		INNER JOIN tipoimagem ti ON ti.idtipoimagem = it.tipoimagemid;
    
CREATE VIEW  atividades_alunos AS
SELECT idatividade_aluno, descricaoatividade, tabuleiroid, tabuleiro.descricao 'descricaotabuleiro', usuario.nomeCompletoUsuario 'nomeusuario', atividadeid, atividade.descricao, `status`, datainicio, datafim 
	FROM softedu.atividade_aluno
		INNER JOIN softedu.usuario ON atividade_aluno.usuarioid = usuario.idusuario
        INNER JOIN softedu.tabuleiro ON atividade_aluno.tabuleiroid = tabuleiro.idtabuleiro
        INNER JOIN softedu.atividade ON atividade_aluno.atividadeid = atividade.idatividade;

CREATE VIEW  imagensdostabuleiros AS
SELECT idimagenstabuleiro, urlImagem, tipoimagemid, tipoimagem.descricao, tipoimagem.tipoimagem 
	FROM softedu.imagenstabuleiro
		INNER JOIN softedu.tipoimagem ON imagenstabuleiro.tipoimagemid = tipoimagem.idtipoimagem;
		
CREATE VIEW  imagens_cenario AS
SELECT tabuleiroID, posicaoTabuleiro, idimagenstabuleiro, urlImagem, tipoimagemid, descricao, tipoimagem
	FROM tabuleiro_imagenstabuleiro
		INNER JOIN imagensdostabuleiros ON tabuleiro_imagenstabuleiro.imagenstabuleiroID = imagensdostabuleiros.idimagenstabuleiro; 
    
delimiter $$
	CREATE PROCEDURE dados_usuario(IN x INT)
	    BEGIN
	    	SELECT usuario.idusuario, usuario.nomeCompletoUsuario, usuario.dataCadastro, perfilusuario.descricao, usuario.login
				FROM softedu.usuario
					INNER JOIN softedu.perfilusuario ON usuario.perfilUsuarioID = perfilusuario.idPerfilUsuario
				WHERE idusuario =  x;
	    END
$$