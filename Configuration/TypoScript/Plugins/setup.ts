# === Plugin Configuration ===

plugin {
  tx_t3vcore {
    persistence {
      enableAutomaticCacheClearing = 1

      updateReferenceIndex = 1

      # storagePid = {$plugin.tx_t3vcore.persistence.storagePid}
    }

    view {
      layoutRootPath = {$plugin.tx_t3vcore.view.layoutRootPath}

      templateRootPath = {$plugin.tx_t3vcore.view.templateRootPath}

      partialRootPath = {$plugin.tx_t3vcore.view.partialRootPath}
    }

    settings {
      # ...
    }
  }
}