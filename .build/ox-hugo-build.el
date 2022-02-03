;; Package configuration
(package-initialize)
(add-to-list 'package-archives '("nongnu" . "https://elpa.nongnu.org/nongnu/") t)
(add-to-list 'package-archives '("melpa" . "https://melpa.org/packages/") t)

(setq-default load-prefer-newer t)
(setq-default package-enable-at-startup nil)

(package-refresh-contents)
(package-install 'use-package)
(setq package-user-dir (expand-file-name "./.packages"))
(add-to-list 'load-path package-user-dir)
(require 'use-package)

(setq use-package-always-ensure t)

;; Install and configure necessary packages
(use-package org
  :pin gnu
  :config
  (setq org-todo-keywords '((sequence
                             "TODO(t!)" "NEXT(n!)" "STARTED(a!)" "WAIT(w@/!)" "SOMEDAY(s)"
                             "|" "DONE(d!)" "CANCELLED(c@/!)"))))

(use-package ox-hugo
  :after org)

;; Export blog posts
(defun mmk2410/export (file)
  (save-excursion
    (find-file file)
    (org-hugo-export-wim-to-md t)))

(mapcar (lambda (file) (mmk2410/export file))
        (directory-files (expand-file-name "./content-org/") t "\\.org$"))
