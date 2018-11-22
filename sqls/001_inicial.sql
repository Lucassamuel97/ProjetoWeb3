[ CREATE DATABASE projeto_web3 COLLATE 'utf8_unicode_ci'; ]

 [ CREATE TABLE `livros`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `autor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `q_exemplares` int(11) NULL DEFAULT NULL,
  `ano` year NULL DEFAULT NULL,
  `q_emprestados` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact; ]

[ INSERT INTO `livros` VALUES (116, 'Livro teste 1', 'Autor teste 1', 2, 2011, 0); ]

[ CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` char(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `endereco` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `bairro` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `rg` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cpf` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data_nasc` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nome`(`nome`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1037 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;
]

 [ INSERT INTO `usuarios` VALUES (1, 'admin', '$2y$10$qZtfPpOqMfIjmB6b49gncukz4r2sNP7nQ43SJUmkuZSd6tSzlkO.6', 1, 'Palmital, rua xv novembro', 'Centro', '12', '123123213', '04320211910', '2018-11-22'); ]
 [ INSERT INTO `usuarios` VALUES (2, 'joao', '$2y$10$wffOWPHomY1a.jc.epZvPukEOLIlUMq7Nzs276H3dlwrRg/NcGsu.', 0, 'Teste', 'Bairro teste', '12', '123124214', '123124214', '2018-11-15'); ]


[ CREATE TABLE `emprestimos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `data` date NOT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `emprestimos_ibfk_1`(`id_usuario`) USING BTREE,
  INDEX `id_livro`(`id_livro`) USING BTREE,
  CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact; ]

  
[ CREATE TRIGGER `insert_livros` BEFORE INSERT ON `emprestimos` FOR EACH ROW BEGIN
	     UPDATE livros SET q_emprestados = q_emprestados + 1 WHERE livros.id = NEW.id_livro;
END; ]

SET FOREIGN_KEY_CHECKS = 1;